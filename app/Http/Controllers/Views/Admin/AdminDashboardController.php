<?php

namespace App\Http\Controllers\Views\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view('pages.admin.dashboard.index', compact('user'));
    }
}
