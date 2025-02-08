<?php

namespace App\Http\Controllers\Backend\v1\Mitras;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MitraProductController extends Controller
{
    public function storeProduct(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'cover' => ['required', 'image'],
            'status' => ['required', 'in:draft,active,inactive'],
            'category_id' => ['required', 'exists:categories,id'],
            'attachemnts.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors(),
                ], 400);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['mitra_id'] = $request->user()->id;
        $data['slug'] = $this->makeSlug($request->name);

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $path = $file->storeAs('products/' . $data['slug'], $file->hashName());
            $filePath = Storage::url($path);
            $data['cover'] = $filePath;
        }

        if ($id != null) {
            $product = Product::find($id);
            if ($product != null && $product->mitra_id != $request->user()->id) {
                if ($request->wantsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'You are not authorized to update this product',
                    ], 400);
                }

                return redirect()->back()->with('error', 'You are not authorized to update this product');
            }

            $product->update($data);
        }

        $product = Product::create($data);

        if ($request->hasFile('attachments')) {
            $attachments = $request->attachments;
            $attachmentPaths = [];

            $folderPath = 'products/' . $product->slug;
            foreach ($attachments as $attachment) {
                $path = $attachment->storeAs($folderPath, $attachment->hashName());
                $filePath = Storage::url($path);
                $attachmentPaths[] = ['image_path' => $filePath];
            }

            $product->attachments()->createMany($attachmentPaths);
        }

        $response = $product;

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'data' => $response,
            ], 200);
        }

        // return redirect()->route('mitra.product.index')->with('success', 'Product has been saved');
        return true;
    }

    public function deleteProduct(Request $request, $id)
    {
        $product = Product::find($id);
        $product->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product deleted successfully',
            ], 200);
        }

        // return redirect()->back()->with('success', 'Product deleted successfully');
        return true;
    }
}
