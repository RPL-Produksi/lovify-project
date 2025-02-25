<?php

namespace App\Http\Controllers\Views\Clients;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientOrderProgresController extends Controller
{
    public function orderProgres(Order $order) {
        $user = Auth::user();
        $progres = OrderProgress::where('order_id', $order->id)
            ->with('order.planning.products.vendor.category') // Pastikan ini benar
            ->get();
    
        return view('pages.client.order.progres.index', compact('user', 'progres'));
    }    
}
