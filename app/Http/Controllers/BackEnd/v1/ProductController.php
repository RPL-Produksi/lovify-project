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
    public function getProducts(Request $request, $slug = null)
    {
        $user = Auth::user();
        $products = Product::query();

        if ($user->role == 'mitra') {
            $vendor = Vendor::where('mitra_id', $user->id)->first();
            $products->where('vendor_id', $vendor->id);
        } else if ($user->role == 'client') {
            $products->where('status', 'active');
        }
        
        $categoryQuery = $request->query('category');
        $statusQuery = $request->query('status');
        
        if ($slug != null) {
            $products->where('slug', $slug);
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
                'attachments' => $product->attachments,
            ];
        });
        $response = $products;

        return response()->json([
            'status' => 'success',
            'message' => 'Data Product',
            'data' => $response,
        ], 200);
    }
}
