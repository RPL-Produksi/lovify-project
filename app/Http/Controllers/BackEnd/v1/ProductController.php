<?php

namespace App\Http\Controllers\Backend\v1;

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
            $products->where('mitra_id', $user->id);
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

            $products = $products->where('category_id', $category->id);
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
        if ($categoryQuery != null) {
            $response['category'] = $categoryQuery;
        };
        $response['products'] = $products;
        $response['products']->map(function ($product) use ($categoryQuery) {
            unset($product->category_id);
            unset($product->mitra_id);
            unset($product->category->id);
            if ($categoryQuery != null) {
                unset($product->category);
            }
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Data Product',
            'data' => $response,
        ], 200);
    }
}
