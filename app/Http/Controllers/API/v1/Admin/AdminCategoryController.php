<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminCategoryController extends Controller
{
    public function storeCategory(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            if ($request->isJson($request)) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors(),
                ], 400);
            }

            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        $category = Category::updateOrCreate(['id' => @$id], [
            'name' => $request->name,
        ]);

        if ($request->isJson()) {
            $response = [
                'status' => 'success',
                'message' => 'Category has been saved',
                'data' => [
                    'id' => $category->id,
                    'name' => $category->name,
                ],
            ];

            return response()->json($response, 200);
        }

        return True;
    }

    public function deleteCategory(Request $request, $id)
    {
        $Category = Category::find($id);

        if (!$Category) {
            if ($request->isJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Category not found',
                ], 404);
            }

            return redirect()->back()->withInput($request->all())->withErrors('Category not found');
        }

        $Category->delete();

        if ($request->isJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Category has been deleted',
            ], 200);
        }

        return True;
    }

    public function getCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page' => ['integer', 'min:1'],
            'size' => ['integer', 'min:1', 'max:100'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        $page = $request->input('page', 1);
        $size = $request->input('size', 10);

        $categories = Category::orderBy('name', 'ASC')
            ->paginate($size, ['*'], 'page', $page);

        $response = [
            'status' => 'success',
            'message' => 'Get categories with pagination',
            'data' => $categories->items(),
            'pagination' => [
                'current_page' => $categories->currentPage(),
                'total_pages' => $categories->lastPage(),
                'total_items' => $categories->total(),
                'items_per_page' => $categories->perPage(),
            ],
        ];

        return response()->json($response, 200);
    }

    public function getCategoryById($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Get category by id',
            'data' => $category
        ], 200);
    }
}
