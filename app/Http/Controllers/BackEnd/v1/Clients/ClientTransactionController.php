<?php

namespace App\Http\Controllers\BackEnd\v1\Clients;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class ClientTransactionController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function storePayment(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'payment_type' => ['required', 'in:down_payment,remaining_payment,full_payment'],
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

        $order = Order::find($id);

        if (!$order) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Order not found',
                ], 404);
            }

            return redirect()->back()->with('error', 'Order not found');
        }

        if ($order->planning->client_id != $request->user()->id) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized',
                ], 401);
            }

            return redirect()->back()->with('error', 'Unauthorized');
        }

        $payments = Payment::where('order_id', $order->id)->get();

        if ($payments->where('status', 'pending')->isNotEmpty()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You still have pending payment',
                ], 400);
            }

            return redirect()->back()->with('error', 'You still have pending payment');
        }

        $hasDp = $payments->where('payment_type', 'down_payment')->where('status', 'completed')->isNotEmpty();
        $hasRemaining = $payments->where('payment_type', 'remaining_payment')->where('status', 'completed')->isNotEmpty();;
        $hasFull = $payments->where('payment_type', 'full_payment')->where('status', 'completed')->isNotEmpty();;

        if ($hasFull || ($hasDp && $hasRemaining)) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You already completed the payment',
                ], 400);
            }

            return redirect()->back()->with('error', 'You already completed the payment');
        }

        if ($hasDp && in_array($request->payment_type, ['down_payment', 'full_payment'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'You can only pay the remaining amount',
            ], 400);

            return redirect()->back()->with('error', 'You can only pay the remaining amount');
        }

        if ($request->payment_type == 'remaining_payment' && !$hasDp) {
            return response()->json([
                'status' => 'error',
                'message' => 'You must pay the down payment first',
            ], 400);

            return redirect()->back()->with('error', 'You must pay the down payment first');
        }

        $amount = match ($request->payment_type) {
            'down_payment' => $order->down_payment,
            'remaining_payment' => $order->remaining_payment,
            'full_payment' => $order->total_price,
        };

        $data = [
            'payment_type' => $request->payment_type,
            'payment_date' => Carbon::now(),
            'amount' => $amount,
            'order_id' => $id,
        ];

        try {
            $invoice = Str::uuid();
            $params = [
                'transaction_details' => [
                    'order_id' => $invoice,
                    'gross_amount' => $data['amount'],
                ],
                'expiry' => [
                    'start_time' => now()->format('Y-m-d H:i:s O'),
                    'unit' => 'minutes',
                    'duration' => '10'
                ]
            ];

            $snapToken = Snap::getSnapToken($params);
            $payment = Payment::create($data);

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Payment created',
                    'data' => [
                        'snap_token' => $snapToken,
                        'payment' => $payment,
                    ],
                ], 201);
            }

            return redirect()->back()->with('success', 'Payment created');
        } catch (\Throwable $th) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $th->getMessage(),
                ], 500);
            }

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function getTransactions(Request $request){
        $user = $request->user();
        $transactions = Payment::whereHas('order.planning', function ($query) use ($user) {
            $query->where('client_id', $user->id);
        })->get();

        if ($request->wantsJson()) {
            $response = $transactions->map(function ($transaction) {
                return [
                    'id' => $transaction->id,
                    'amount' => $transaction->amount,
                    'payment_date' => $transaction->payment_date,
                    'payment_type' => $transaction->payment_type,
                    'status' => $transaction->status,
                    'order' => [
                        'id' => $transaction->order->id,
                        'total_price' => $transaction->order->total_price,
                        'down_payment' => $transaction->order->down_payment,
                        'remaining_payment' => $transaction->order->remaining_payment,
                    ],
                    'planning' => [
                        'id' => $transaction->order->planning->id,
                        'title' => $transaction->order->planning->title,
                        'description' => $transaction->order->planning->description,
                    ],
                ];
            });
            return response()->json([
                'status' => 'success',
                'data' => $response,
            ]);
        }

        // return view('transactions', compact('transactions'));
        return true;
    }
}
