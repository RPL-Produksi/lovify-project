<?php

namespace App\Http\Controllers\Backend\v1\Admins;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminCategoryController extends Controller
{
    public function storeCategory(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $data = $request->all();
        $data['name'] = strtolower($data['name']);
        $category = Category::updateOrCreate(['id' => $id], $data);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Category created successfully',
                'data' => $category,
            ], 200);
        }

        // return redirect()->back()->with('success', 'Category created successfully');
        return true;
    }

    public function deleteCategory(Request $request, $id)
    {
        $category = Category::find($id);
        $category->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Category deleted successfully',
            ], 200);
        }

        // return redirect()->back()->with('success', 'Category deleted successfully');
        return true;
    }
}
