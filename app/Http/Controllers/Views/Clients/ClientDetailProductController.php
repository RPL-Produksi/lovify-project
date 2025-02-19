<?php

namespace App\Http\Controllers\Views\Clients;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientDetailProductController extends Controller
{
    public function index($id) {
        $user = Auth::user();
        $product = Product::findOrFail($id);
        $planning = Planning::where('client_id', $user->id)->get();

        return view('pages.client.detail_product.index', compact('product', 'user', 'planning'));
    }
}
