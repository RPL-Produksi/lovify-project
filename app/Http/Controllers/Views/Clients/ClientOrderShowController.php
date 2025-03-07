<?php

namespace App\Http\Controllers\Views\Clients;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProgress;
use App\Models\Payment;
use App\Models\Planning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientOrderShowController extends Controller
{
    public function index(Planning $planning)
    {
        $user = Auth::user();
        $order = Order::where('planning_id', $planning->id)->get();
        return view('pages.client.order.index', compact('user', 'order'));
    }

    public function detail($id)
    {
        $order = Order::find($id);
        $order->with('planning.products.vendor.category');

        $isPaid = Payment::where('order_id', $order->id)
            ->whereIn('payment_type', ['full_payment', 'remaining_payment'])
            ->where('status', 'completed')
            ->exists();

        $user = Auth::user();
        return view('pages.client.order.detail', compact('user', 'order', 'isPaid'));
    }

    public function history()
    {
        $user = Auth::user();
        $orders = Order::whereHas('planning', function ($query) use ($user) {
            $query->where('client_id', $user->id);
        })->get();

        return view('pages.client.order.history.index', compact('orders', 'user'));
    }
}
