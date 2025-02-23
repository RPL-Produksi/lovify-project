<?php

namespace App\Http\Controllers\Views\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminKelolaLokasiController extends Controller
{
    public function index() {
        $user = Auth::user();
        $location = Location::all();
        return view('pages.admin.lokasi.index', compact('location', 'user'));
    }

    public function getData() {
        return response()->json(Location::all());
    }
}
