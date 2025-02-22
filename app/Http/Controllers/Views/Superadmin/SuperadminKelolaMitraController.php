<?php

namespace App\Http\Controllers\Views\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperadminKelolaMitraController extends Controller
{
    public function index() {
        $user = Auth::user();
        $mitra = User::where('role', 'mitra')->get();
        return view('pages.superadmin.mitra.index', compact('mitra', 'user'));
    }

    public function getData() {
        return response()->json(User::where('role', 'mitra')->get());
    }
}
