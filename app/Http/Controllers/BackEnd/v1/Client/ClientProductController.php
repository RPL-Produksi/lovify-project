<?php

namespace App\Http\Controllers\BackEnd\v1\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientProductController extends Controller
{
    public function getProduct(Request $request, $id = null)
    {
        if ($id) {
            $product = Product::find($id);
            
            if (!$product) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product Not Found',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $product,
            ], 200);
        }

        $validator = Validator::make($request->all(), [
            'limit' => 'integer',
            'offset' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        $limit = $request->limit ?? 10;
        $offset = $request->offset ?? 0;

        $products = Product::limit($limit)->offset($offset)->get();
        return response()->json([
            'status' => 'success',
            'offset' => $offset,
            'limit' => $limit,
            'data' => $products,
        ], 200);
    }

    public function getProductByCategory(Category $category)
    {
        dd($category);
        $category = Category::find($category->id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category Not Found',
            ], 404);
        }

        $products = $category->products;
        return response()->json([
            'status' => 'success',
            'category' => $category->name,
            'data' => $products,
        ], 200);
    }
}
