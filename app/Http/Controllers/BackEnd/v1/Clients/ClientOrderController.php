<?php

namespace App\Http\Controllers\BackEnd\v1\Clients;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Planning;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientOrderController extends Controller
{
    public function storeOrder(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'marry_date' => ['required', 'date', 'after:' . Carbon::now()->addMonths(6)],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        

        $planning = Planning::find($id);

        if (!$planning) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Planning not found',
                ], 404);
            }

            return redirect()->back()->with('error', 'Planning not found');
        }

        $products_ids = $planning->products->pluck('id')->toArray();
        if (count($products_ids) < 1) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Products not found',
                ], 404);
            }

            return redirect()->back()->with('error', 'Products not found');
        }
        
        $orderSameDate = Order::where('marry_date', $request->marry_date)->whereHas('planning.products', function ($query) use ($products_ids) {
            $query->whereIn('id', $products_ids);
        })->exists();

        if ($orderSameDate) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Order already exist in the same date with the same products',
                ], 400);
            }

            return redirect()->back()->with('error', 'Order already exist in the same date with the same products');
        }

        $totalPrice = $planning->products->sum('price');
        $downPayment = $totalPrice * 0.3;
        $remainingPayment = $totalPrice - $downPayment;
        $data = [
            'dp_deadline' => Carbon::parse($request->marry_date)->subMonth(4),
            'payment_deadline' => Carbon::parse($request->marry_date)->subMonth(2),
            'marry_date' => $request->marry_date,
            'status' => 'pending',
            'planning_id' => $planning->id,
            'total_price' => $totalPrice,
            'down_payment' => $downPayment,
            'remaining_payment' => $remainingPayment,
        ];

        $order = Order::create($data);
        foreach ($products_ids as $product_id) {
            $order->orderProgress()->create([
                'product_id' => $product_id,
                'status' => 'pending',
            ]);
        }

        if ($request->wantsJson()) {
            $response = [
                'id' => $order->id,
                'total_price' => $order->total_price,
                'down_payment' => $order->down_payment,
                'remaining_payment' => $order->remaining_payment,
                'dp_deadline' => $order->dp_deadline,
                'payment_deadline' => $order->payment_deadline,
                'marry_date' => $order->marry_date,
                'status' => $order->status,
                'order_progress' => $order->orderProgress->map(function ($query) {
                    return [
                        'product' => $query->product->name,
                        'status' => $query->status,
                    ];
                }),
            ];
            return response()->json([
                'status' => 'success',
                'message' => 'Order created',
                'data' => $response,
            ], 201);
        }

        return redirect()->back()->with('success', 'Order created, please check order menu');
        // return true;
    }

    public function getOrders(Request $request)
    {
        $user = $request->user();
        $orders = Order::whereHas('planning', function ($query) use ($user) {
            $query->where('client_id', $user->id);
        })->get();

        if ($request->wantsJson()) {
            $response = $orders->map(function ($order) {
                return [
                    'id' => $order->id,
                    'total_price' => $order->total_price,
                    'down_payment' => $order->down_payment,
                    'remaining_payment' => $order->remaining_payment,
                    'dp_deadline' => $order->dp_deadline,
                    'payment_deadline' => $order->payment_deadline,
                    'marry_date' => $order->marry_date,
                    'status' => $order->status,
                    'order_progress' => $order->orderProgress->map(function ($order) {
                        return [
                            'product' => $order->product->name,
                            'status' => $order->status,
                        ];
                    }),
                ];
            });
            return response()->json([
                'status' => 'success',
                'data' => $response,
            ]);
        }

        // return view('clients.orders', compact('orders'));
        return true;
    }
}
