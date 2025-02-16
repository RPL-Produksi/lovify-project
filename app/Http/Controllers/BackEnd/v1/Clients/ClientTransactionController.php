<?php

namespace App\Http\Controllers\BackEnd\v1\Clients;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Config;

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

        // if ($order->planning)
    }
}
