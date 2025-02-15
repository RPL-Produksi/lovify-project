<?php

namespace App\Http\Controllers\Views\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class MitraKelolaProdukController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        if ($user->vendor) {
            $produk = $user->vendor->products;
        } else {
            $produk = [];
        }
        return view('pages.mitra.produk.index', compact('produk', 'user'));
    }
}
