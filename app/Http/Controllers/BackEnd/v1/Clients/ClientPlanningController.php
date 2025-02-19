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
            'product_ids' => ['required', 'array'],
            'product_ids.*' => ['required', 'exists:products,id', 'min:1'],
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

        $productCategories = Product::whereIn('id', $request->product_ids)->with('vendor.category')->get()->pluck('vendor.category.id')->toArray();
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

                // return redirect()->back()->with('error', 'Planning not found');
                return true;
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

        // return redirect()->back()->with('success', 'Planning created successfully');
        return true;
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

            // return redirect()->back()->with('error', 'Planning not found');
            return true;
        }

        if ($request->user()->id != $planning->client_id) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You are not authorized to delete this planning',
                ], 403);
            }

            // return redirect()->back()->with('error', 'You are not authorized to delete this planning');
            return true;
        }

        $planning->delete();
        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Planning deleted successfully',
            ], 200);
        }

        // return redirect()->back()->with('success', 'Planning deleted successfully');
        return true;
    }
}
