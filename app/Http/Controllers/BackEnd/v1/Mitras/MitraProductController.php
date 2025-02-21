<?php

namespace App\Http\Controllers\BackEnd\v1\Mitras;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MitraProductController extends Controller
{
    public function storeProduct(Request $request, $id = null)
    {
        $user = $request->user();
        $vendor = $user->vendor;
        if ($vendor == null) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You cannot create product without being a vendor',
                ], 400);
            }

            return redirect()->back()->with('error', 'You are not authorized to create product');
        }
        
        $rule = [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'status' => ['required', 'in:draft,active,inactive'],
            'attachments.*' => ['nullable', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];

        if ($id == null) {
            $rule['cover'] = ['required', 'mimes:jpeg,png,jpg', 'max:2048'];
        } else {
            $rule['cover'] = ['nullable', 'mimes:jpeg,png,jpg', 'max:2048'];
        }
        $validator = Validator::make($request->all(), $rule);
        
        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors(),
                ], 400);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->status == 'active' && !$vendor->is_verified && !$vendor->is_active) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You cannot create active product without being an active vendor',
                ], 400);
            }

            return redirect()->back()->with('error', 'You cannot create active product without being an active vendor');
        }

        $data = $request->all();
        $data['slug'] = $this->makeSlug($request->name);
        $data['vendor_id'] = $vendor->id;
        
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $path = $file->storeAs('products/' . $data['slug'], $file->hashName());
            $filePath = Storage::url($path);
            $data['cover'] = $filePath;
        }
        
        if ($id != null) {
            $product = Product::find($id);
            if ($product != null && $product->vendor_id != $request->user()->vendor->id) {
                dd($request->all());
                if ($request->wantsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'You are not authorized to update this product',
                    ], 400);
                }

                return redirect()->back()->with('error', 'You are not authorized to update this product');
            }

            $product->update($data);
        } else {
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
        }
        
        if ($request->wantsJson()) {
            $response = [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'description' => $product->description,
                'price' => $product->price,
                'cover' => $product->cover,
                'status' => $product->status,
                'vendor' => $product->vendor->name,
                'location' => $product->vendor->location->name,
                'category' => $product->vendor->category->name,
                'attachments' => $product->attachments,
            ];
            return response()->json([
                'status' => 'success',
                'data' => $response,
            ], 200);
        }

        return redirect()->back()->with('success', 'Product has been saved');
    }

    public function deleteProduct(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product == null) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product not found',
                ], 404);
            }
            return redirect()->back()->with('error', 'Product not found');
        }

        if ($product->vendor_id != $request->user()->vendor->id) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You are not authorized to delete this product',
                ], 400);
            }
            return redirect()->back()->with('error', 'You are not authorized to delete this product');
        }

        $product->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product deleted successfully',
            ], 200);
        }

        return redirect()->back()->with('success', 'Product deleted successfully');
    }
}
