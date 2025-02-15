<?php

namespace App\Http\Controllers\Views\Mitra;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MitraDashboardController extends Controller
{
    public function index() {
        $user = Auth::user();
        if ($user->vendor == null) {
            return redirect()->route('mitra.tambah.vendor.show');
        }
        return view('pages.mitra.home.index', compact('user'));
    }
}
