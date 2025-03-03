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
    public function index($categoryId)
    {
        // dd($categoryId);
        $user  = Auth::user();
        $products = Product::where('status', 'active')->whereHas('vendor', function ($query) use ($categoryId) {
            $query->where('category_id', $categoryId);
        })->get();

        // dd($products);
        return view('pages.client.vendors.index', compact('products','user'));
    }
}
