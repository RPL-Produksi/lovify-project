<?php

namespace App\Http\Controllers\Views\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SuperadminKelolaAdminController extends Controller
{
    public function index() {
        $admin = User::where('role', 'admin');
        return view('pages.superadmin.admin.index', compact('admin'));
    }
}
