<?php

namespace App\Http\Controllers\Views\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperadminKelolaAdminController extends Controller
{
    public function index() {
        $user = Auth::user();
        $admin = User::where('role', 'admin')->get();
        return view('pages.superadmin.admin.index', compact('admin', 'user'));
    }

    public function getData() {
        return response()->json(User::where('role', 'admin')->get());
    }
}
