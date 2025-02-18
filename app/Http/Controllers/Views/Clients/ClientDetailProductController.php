<?php

namespace App\Http\Controllers\Views\Clients;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientDetailProductController extends Controller
{
    public function index($id) {
        $user = Auth::user();
        $product = Product::findOrFail($id);

        return view('pages.client.detail_product.index', compact('product', 'user'));
    }
}
