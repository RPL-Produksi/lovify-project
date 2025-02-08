<?php

namespace App\Http\Controllers\Backend\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts(Request $request, $id = null)
    {
        $products = Product::query();
        $categoryQuery = $request->query('category');

        if ($id != null) {
            $products = $products->where('id', $id);
        }

        if ($categoryQuery != null) {
            $category = Category::where('name', $categoryQuery)->first();
            if ($category == null) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid Category',
                ], 400);
            }

            $products = $products->where('category_id', $category->id);
        }

        $products = $products->get();
        $response = [];
        if ($categoryQuery != null) {
            $response['category'] = $categoryQuery;
        }
        $response['products'] = $products;

        return response()->json([
            'status' => 'success',
            'message' => 'Data Product',
            'data' => $response,
        ], 200);
    }
}
