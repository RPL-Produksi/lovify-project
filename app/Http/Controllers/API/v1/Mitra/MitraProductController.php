<?php

namespace App\Http\Controllers\API\v1\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAttachment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MitraProductController extends Controller
{
    public function storeProduct(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'cover' => 'required|image',
            'status' => 'required|in:draft,active,inactive',
            'attachments.*' => 'nullable|image|file',
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

        $input = $request->all();
        $input['slug'] = $this->makeSlug($request->name);
        $input['mitra_id'] = Auth::user()->id;

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $storedFile = $file->storeAs('product' . '/' . $input['slug'] . '/' . Auth::user()->username . '/' . 'cover', $file->hashName());
            $filePath = Storage::url($storedFile);
            $input['cover'] = $filePath;
        }

        $product = Product::updateOrCreate(['id' => $id], $input);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachment) {
                $storedFile = $attachment->storeAs(
                    'product' . '/' . $product->slug . '/' . Auth::user()->username . '/' . 'attachments',
                    $attachment->hashName()
                );

                $filePath = Storage::url($storedFile);

                $productAttachment = new ProductAttachment();
                $productAttachment->product_id = $product->id;
                $productAttachment->image_path = $filePath;
                $productAttachment->save();
            }
        }

        if ($request->wantsJson()) {
            $response = [
                'status' => 'success',
                'message' => 'Product saved successfully',
                'data' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'description' => $product->description,
                    'status' => $product->status,
                ],
            ];

            return response()->json($response, 201);
        }

        return redirect()->route('products.index')->with('success', 'Product saved successfully');
    }

    public function deleteProduct(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->where('mitra_id', Auth::user()->id)->first();

        if (!$product) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product not found',
                ], 404);
            }

            return redirect()->back()->withInput($request->all())->withErrors('Product not found');
        }

        $product->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product has been deleted',
            ], 200);
        }

        return redirect()->route('products.index')->with('success', 'Product has been deleted');
    }

    public function getProducts(Request $request)
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

        $products = Product::orderBy('name', 'ASC')->with(['user', 'attachments'])->paginate($size, ['*'], 'page', $page);

        $response = [
            'status' => 'success',
            'message' => 'Get products with pagination',
            'data' => $products->items(),
            'pagination' => [
                'current_page' => $products->currentPage(),
                'total_pages' => $products->lastPage(),
                'total_items' => $products->total(),
                'items_per_page' => $products->perPage(),
            ],
        ];

        return response()->json($response, 200);
    }

    public function getProductsBySlug($slug)
    {
        $product = Product::where('slug', $slug)->with(['user', 'attachments'])->first();

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Get product by id',
            'data' => $product
        ], 200);
    }
}
