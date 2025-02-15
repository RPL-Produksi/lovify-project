<?php

namespace App\Http\Controllers\Views\Clients;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ClientVendorsController extends Controller
{
    public function index(Category $category) {
        $user  = Auth::user();
        $products = Product::where("category_id", $category->id)->with('user')->get();
        $products->map(function ($product) {
            $product['mitra'] = $product->user->username;
        });
        return view('pages.client.vendors.index', compact('products','user'));
    }
}
