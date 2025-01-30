<?php

namespace App\Http\Controllers\BackEnd\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminCategoryController extends Controller
{
    // API And Web
    public function storeCategory(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
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

        if ($request->wantsJson()) {
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
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Category not found',
                ], 404);
            }

            return redirect()->back()->withInput($request->all())->withErrors('Category not found');
        }

        $Category->delete();

        if ($request->wantsJson()) {
            $response = [
                'status' => 'success',
                'message' => 'Category has been deleted',
            ];

            return response()->json($response, 200);
        }

        return True;
    }
}
