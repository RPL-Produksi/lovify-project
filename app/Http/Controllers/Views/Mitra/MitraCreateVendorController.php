<?php

namespace App\Http\Controllers\Views\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;

class MitraCreateVendorController extends Controller
{
    public function index() {
        $kategori = Category::all();
        $lokasi = Location::all();
        return view('pages.mitra.vendor.index', compact('kategori','lokasi'));
    }
}
