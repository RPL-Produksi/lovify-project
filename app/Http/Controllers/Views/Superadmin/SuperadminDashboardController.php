<?php

namespace App\Http\Controllers\Views\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperadminDashboardController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view('pages.superadmin.dashboard.index', compact('user'));   
    }
}
