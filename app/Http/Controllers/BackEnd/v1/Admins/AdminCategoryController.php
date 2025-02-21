<?php

namespace App\Http\Controllers\BackEnd\v1\Admins;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminCategoryController extends Controller
{
    public function storeCategory(Request $request, $id = null)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'mimes:jpeg,png,jpg', 'max:2048']
        ];

        if (!$id && !$request->id) {
            $rules['image'] = ['required', 'mimes:jpeg,png,jpg', 'max:2048'];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $data = $request->only('name');
        $data['name'] = strtolower($data['name']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->storeAs('categories/' . $request->name, $image->hashName());
            $data['image'] = Storage::url($path);
        }

        if ($request->id) {
            $category = Category::findOrFail($request->id);
            $category->update($data);
            $message = 'Category updated successfully';
        } else {
            $category = Category::create($data);
            $message = 'Category created successfully';
        }

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'data' => $category,
            ], 200);
        }

        return redirect()->back()->with('success', $message);
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

        return redirect()->back()->with('success', 'Category deleted successfully');
        // return true;
    }
}
