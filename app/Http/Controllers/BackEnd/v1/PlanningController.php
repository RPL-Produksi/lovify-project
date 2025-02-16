<?php

namespace App\Http\Controllers\BackEnd\v1;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use Illuminate\Http\Request;

class PlanningController extends Controller
{
    public function getPlanning(Request $request, $id = null)
    {
        $plannings = Planning::query();

        if ($id != null) {
            $plannings->find($id);
            if ($plannings == null) {
                if ($request->wantsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Planning not found',
                    ], 404);
                }

                // return redirect()->back()->with('error', 'Planning not found');
                return true;
            }

            if ($request->user()->id != $plannings->client_id) {
                if ($request->wantsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'You are not authorized to view this planning',
                    ], 403);
                }

                // return redirect()->back()->with('error', 'You are not authorized to view this planning');
                return true;
            }
        }

        if ($request->user()->role == 'client') {
            $plannings->where('client_id', $request->user()->id);
        } else if ($request->user()->role == 'mitra') {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to view this planning',
            ], 403);
        }
        
        $plannings = $plannings->get();
        $plannings = $plannings->map(function ($planning) {
            return [
                'id' => $planning->id,
                'title' => $planning->title,
                'description' => $planning->description,
                'products' => $planning->products->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'slug' => $product->slug,
                        'price' => $product->price,
                        'location' => $product->vendor->location->name,
                        'category' => $product->vendor->category->name,
                        'vendor' => $product->vendor->name
                    ];
                })
            ];
        });
        
        

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'data' => $plannings,
            ], 200);
        }

        // return view('planning.index', compact('plannings'));
        return true;
    }
}
