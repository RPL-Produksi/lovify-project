<?php

namespace App\Http\Controllers\Views\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MitraDashboardController extends Controller
{
    public function index() {
        $user = Auth::user();
        if ($user->vendor == null) {
            return redirect()->route('mitra.tambah.vendor.show');
        }

        
        $kategori = Category::all();

        if ($user->vendor) {
            $produk = $user->vendor->products;
            $totalProduk = $produk->count();
        } else {
            $produk = collect(); 
            $totalProduk = 0;
        }

        return view('pages.mitra.home.index', compact('produk', 'user', 'kategori', 'totalProduk'));
    }
}
