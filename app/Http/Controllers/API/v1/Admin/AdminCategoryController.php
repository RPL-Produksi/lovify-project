<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminCategoryController extends Controller
{
    public function storeCategory(Request $request, $uuid)
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

        if ($uuid != null) {
            $category = Category::find($uuid);
            if ($category == null) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Category not found',
                ], 404);
            }

            $category->name = $request->name;
            $category->save();

            if ($request->isJson($request)) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Category updated successfully',
                    'data' => $category,
                ]);
            }

            return True;
        }

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        if ($request->isJson($request)) {
            return response()->json([
                'status' => 'success',
                'message' => 'Category created successfully',
                'data' => $category,
            ]);
        }

        return True;
    }
}
