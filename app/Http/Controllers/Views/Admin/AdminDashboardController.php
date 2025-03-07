<?php

namespace App\Http\Controllers\Views\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Location;
use App\Models\Vendor;
use Carbon\Traits\Localization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index() {
        $user = Auth::user();
        $totalKategori = Category::count();
        $totalLokasi = Location::count();
        $totalVendor = Vendor::count();
        return view('pages.admin.dashboard.index', compact('user', 'totalKategori', 'totalLokasi', 'totalVendor'));
    }
}
