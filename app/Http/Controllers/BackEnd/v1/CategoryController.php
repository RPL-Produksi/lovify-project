<?php

namespace App\Http\Controllers\BackEnd\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function getCategory(Request $request, $id = null)
    {
        if ($id != null) {
            $category = Category::find($id);
            
            if ($category == null) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Category not found',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Category found',
                'data' => $category,
            ], 200);
        }

        $categories = Category::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Categories found',
            'data' => $categories,
        ], 200);
    }
}
