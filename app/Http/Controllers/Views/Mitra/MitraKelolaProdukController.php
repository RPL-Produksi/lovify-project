<?php

namespace App\Http\Controllers\Views\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class MitraKelolaProdukController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $kategori = Category::all();
        if ($user->vendor) {
            $produk = $user->vendor->products;
        } else {
            $produk = [];
        }
        return view('pages.mitra.produk.index', compact('produk', 'user', 'kategori'));
    }

    public function getData(Request $request)
    {
        $user = $request->user();

        $vendor = $user->load('vendor.products')->vendor;

        if (!$vendor) {
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak memiliki vendor',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'produk' => $vendor->products,
        ], 200);
    }
}
