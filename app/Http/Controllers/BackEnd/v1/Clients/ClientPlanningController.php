<?php

namespace App\Http\Controllers\BackEnd\v1\Clients;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientPlanningController extends Controller
{
    public function storePlanning(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'description' => ['string', 'nullable'],
            'product_ids' => ['nullable', 'array'],
            'product_ids.*' => ['nullable', 'exists:products,id', 'min:1'],
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors(),
                ], 400);
            }

            return redirect()->back()->with('error', $validator->errors());
        }

        $productCategories = Product::whereIn('id', $request->product_ids ?? [])->with('vendor.category')->get()->pluck('vendor.category.id')->toArray();
        if (count($productCategories) != count(array_unique($productCategories))) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product categories must be unique',
                ], 400);
            }

            return redirect()->back()->with('error', 'Product categories must be unique');
        }

        if ($id != null) {
            $planning = Planning::find($id);
            if ($planning == null) {
                if ($request->wantsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Planning not found',
                    ], 404);
                }

                return redirect()->back()->with('error', 'Planning not found');
                // return true;
            }

            $planning->update($request->only('title', 'description'));
            $planning->products()->sync($request->product_ids);

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Planning updated successfully',
                ], 200);
            }

            return redirect()->route('planning')->with('success', 'Planning updated successfully');
            // return true;
        }

        $data = $request->only('title', 'description');
        $data['client_id'] = $request->user()->id;
        $planning = Planning::create($data);
        $planning->products()->sync($request->product_ids);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Planning created successfully',
            ], 201);
        }

        return redirect()->route('planning')->with('success', 'Planning created successfully');
        // return true;
    }

    public function storePlanningSecond(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'planning_id' => ['nullable', 'exists:plannings,id'],
            'title' => ['required_if:planning_id,null', 'string'],
            'description' => ['required_if:planning_id,null', 'string', 'nullable'],
            'product_ids' => ['nullable', 'array'],
            'product_ids.*' => ['nullable', 'exists:products,id', 'min:1'],
        ]);
    
        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors(),
                ], 400);
            }
    
            return redirect()->back()->with('error', $validator->errors());
        }
    
        $data = $request->only('title', 'description');
        $data['client_id'] = $request->user()->id;
    
        $planning = Planning::updateOrCreate(
            ['id' => $request->planning_id],
            $data
        );
    
        $existingProducts = $planning->products()->with('vendor.category')->get();
        $existingCategories = $existingProducts->pluck('vendor.category.id')->toArray();
        $newProducts = Product::whereIn('id', $request->product_ids ?? [])->with('vendor.category')->get();
        
        $newProductCategories = $newProducts->pluck('vendor.category.id')->toArray();
    
        $productsToKeep = $existingProducts->filter(function ($product) use ($newProductCategories) {
            return !in_array($product->vendor->category->id, $newProductCategories);
        })->pluck('id')->toArray();
    
        $mergedProductIds = array_merge($productsToKeep, $request->product_ids ?? []);
    
        $planning->products()->sync($mergedProductIds);
    
        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => $request->planning_id ? 'Planning updated successfully' : 'Planning created successfully',
            ], $request->planning_id ? 200 : 201);
        }
    
        return redirect()->route('planning')->with('success', $request->planning_id ? 'Planning updated successfully' : 'Planning created successfully');
    }


    public function deletePlanning(Request $request, $id)
    {
        $planning = Planning::find($id);
        if ($planning == null) {
            if (request()->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Planning not found',
                ], 404);
            }

            return redirect()->back()->with('error', 'Planning not found');
            // return true;
        }

        if ($request->user()->id != $planning->client_id) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You are not authorized to delete this planning',
                ], 403);
            }

            return redirect()->back()->with('error', 'You are not authorized to delete this planning');
            // return true;
        }

        $planning->delete();
        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Planning deleted successfully',
            ], 200);
        }

        return redirect()->back()->with('success', 'Planning deleted successfully');
        // return true;
    }

    public function getPlannings(Request $request)
    {
        $user = $request->user();
        $plannings = Planning::where('client_id', $user->id)->get();


        // $table->string('title');
        // $table->text('description')->nullable();
        // $table->foreignUuid('client_id')->constrained('users')->cascadeOnDelete();
        if ($request->wantsJson()) {
            $response = $plannings->map(function ($planning) {
                return [
                    'id' => $planning->id,
                    'title' => $planning->title,
                    'description' => $planning->description,
                    'products' => $planning->products->map(function ($product) {
                        return [
                            'id' => $product->id,
                            'name' => $product->name,
                            'price' => $product->price,
                            'category' => $product->vendor->category->name,
                            'vendor' => [
                                'id' => $product->vendor->id,
                                'name' => $product->vendor->name,
                            ],
                        ];
                    }),
                ];
            });

            return response()->json([
                'status' => 'success',
                'data' => $response,
            ]);
        }

        // return view('plannings', compact('plannings'));
        return true;
    }
}
