<?php

namespace App\Http\Controllers\BackEnd\v1\Mitras;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MitraOrderController extends Controller
{
    public function orderList(Request $request)
    {
        $mitra = $request->user();
        $productIds = $mitra->vendor->products->pluck('id');
        $orderProgress = OrderProgress::whereIn('product_id', $productIds)->get();

        $response = $orderProgress->map(function ($orderProgres) {
            return [
                'id' => $orderProgres->id,
                'order_id' => $orderProgres->order_id,
                'product_id' => $orderProgres->product_id,
                'status' => $orderProgres->status,
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $response,
        ]);
    }

    public function updateProductProgress(Request $request, $id)
    {
        $mitra = $request->user();
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:in_progress,completed',
        ]);

        $orderProgress = OrderProgress::find($id);

        if ($orderProgress == null) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Order Progress not found',
                ], 404);
            }

            return redirect()->back()->with('error', 'Order Progress not found');
        }

        if ($orderProgress->product->vendor_id != $mitra->vendor->id) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You are not authorized to update this order progress',
                ], 403);
            }

            return redirect()->back()->with('error', 'You are not authorized to update this order progress');
        }

        $orderProgress->status = $request->status;
        $orderProgress->save();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Order Progress updated successfully',
            ]);
        }

        return redirect()->back()->with('success', 'Order Progress updated successfully');
    }
}
