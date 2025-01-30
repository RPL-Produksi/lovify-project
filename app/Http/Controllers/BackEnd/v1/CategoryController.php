<?php

namespace App\Http\Controllers\Backend\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function getCategory(Request $request)
    {
        // Simple Version

        $categories = Category::orderBy('name', 'ASC')->get();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Get all categories',
            'data' => $categories,
        ], 200);

        // With Pagination (Kali aja ke pake)

        // $validator = Validator::make($request->all(), [
        //     'page' => ['integer', 'min:1'],
        //     'size' => ['integer', 'min:1', 'max:100'],
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => $validator->errors(),
        //     ], 400);
        // }

        // $page = $request->input('page', 1);
        // $size = $request->input('size', 10);

        // $categories = Category::orderBy('name', 'ASC')
        //     ->paginate($size, ['*'], 'page', $page);

        // $response = [
        //     'status' => 'success',
        //     'message' => 'Get categories with pagination',
        //     'data' => $categories->items(),
        //     'pagination' => [
        //         'current_page' => $categories->currentPage(),
        //         'total_pages' => $categories->lastPage(),
        //         'total_items' => $categories->total(),
        //         'items_per_page' => $categories->perPage(),
        //     ],
        // ];

        // return response()->json($response, 200);
    }
}
