<?php

namespace App\Http\Controllers\BackEnd\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function getProducts(Request $request, $id = null)
    {
        $user = Auth::user();
        if ($id) {
            $product = Product::find($id);
            if ($product == null) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product Not Found',
                ], 404);
            }

            if ($user->role == 'mitra' && $product->vendor->mitra_id != $user->id) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized',
                ], 401);
            }

            $product = [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'description' => $product->description,
                'price' => $product->price,
                'cover' => $product->cover,
                'vendor' => $product->vendor->name,
                'location' => $product->vendor->location->name,
                'category' => $product->vendor->category->name,
                'attachments' => $product->attachments->map(function ($attachment) {
                    return [
                        'url' => $attachment->image_path,
                    ];
                }),
            ];

            return response()->json([
                'status' => 'success',
                'message' => 'Data Product',
                'data' => $product,
            ], 200);
        }

        $slug = strtolower($request->query('slug'));
        $vendorId = $request->query('vendorId');
        $categoryQuery = $request->query('category');
        $statusQuery = $request->query('status');
        $products = Product::query();

        if ($user->role == 'mitra') {
            $vendor = Vendor::where('mitra_id', $user->id)->first();
            $products->where('vendor_id', $vendor->id);
        } else if ($user->role == 'client') {
            $products->where('status', 'active');
        }
        
        
        if ($slug) {
            $products->where('slug', $slug);
        }

        if ($vendorId && $user->role == 'client') {
            $products->where('vendor_id', $id);
        }

        if ($categoryQuery != null) {
            $categoryQuery = strtolower($categoryQuery);
            $category = Category::where('name', $categoryQuery)->first();
            if ($category == null) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid Category',
                ], 400);
            }

            $products->whereHas('vendor', function ($query) use ($category) {
                $query->where('category_id', $category->id);
            });
        }

        if ($statusQuery != null) {
            if ($user->role == 'client') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid Query',
                ], 400);
            }

            $statusQuery = strtolower($statusQuery);
            $products->where('status', $statusQuery);
        }

        $products = $products->get();
        $products = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'description' => $product->description,
                'price' => $product->price,
                'cover' => $product->cover,
                'vendor' => $product->vendor->name,
                'location' => $product->vendor->location->name,
                'category' => $product->vendor->category->name,
                'attachments' => $product->attachments->map(function ($attachment) {
                    return [
                        'url' => $attachment->image_path,
                    ];
                }),
            ];
        });
        $response = $products == null ? [] : $products;

        return response()->json([
            'status' => 'success',
            'message' => 'Data Product',
            'data' => $response,
        ], 200);
    }
}
