<?php

namespace App\Http\Controllers\BackEnd\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function getProducts(Request $request, $slug = null)
    {
        $user = Auth::user();
        $products = Product::query();
        if ($user->role == 'mitra') {
            $products->where('vendor_id', $user->vendor->id);
        } else if ($user->role == 'client') {
            $products->where('status', 'active');
        }
        
        $categoryQuery = $request->query('category');
        $statusQuery = $request->query('status');
        
        if ($slug != null) {
            $products = $products->where('slug', $slug);
        }

        if ($categoryQuery != null) {
            $categoryQuery = strtolower($categoryQuery);
            $category = Category::where('name', $categoryQuery)->first();
            if ($category == null) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid Category',
                ], 400);
            }

            $products = $products->vendor->where('category_id', $category->id);
        }

        if ($statusQuery != null) {
            if ($user->role == 'client') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid Query',
                ], 400);
            }

            $statusQuery = strtolower($statusQuery);
            $products = $products->where('status', $statusQuery);
        }

        $products = $products->get();
        $response = [];
        $products->makeHidden(['vendor_id']);
        $products->map(function ($product) {
            if ($product->vendor->profile == null) {
                $product->vendor->profile = asset('vendors/default.png');
            }
            $product->vendor->makeHidden(['id', 'mitra']);
        });
        $response['products'] = $products;

        return response()->json([
            'status' => 'success',
            'message' => 'Data Product',
            'data' => $response,
        ], 200);
    }
}
