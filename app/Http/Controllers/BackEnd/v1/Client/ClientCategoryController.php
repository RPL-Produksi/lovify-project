<?php

namespace App\Http\Controllers\BackEnd\v1\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ClientCategoryController extends Controller
{
    public function getCategory()
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return response()->json([
            'status' => 'success',
            'data' => $categories,
        ], 200);
    }

    public function getProductByCategory($id)
    {
        $category = Category::find($id);

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
