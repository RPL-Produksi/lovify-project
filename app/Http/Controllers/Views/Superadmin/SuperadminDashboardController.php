<?php

namespace App\Http\Controllers\Views\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperadminDashboardController extends Controller
{
    public function index() {
        $user = Auth::user();
        $user['avatar'] = $user->avatar == null ? asset('avatars/default.png') : $user->avatar;
        $totalAdmin = User::where('role', 'admin')->count();
        $totalMitra = User::where('role', 'mitra')->count();
        $totalClient = User::where('role', 'client')->count();
        return view('pages.superadmin.dashboard.index', compact('user', 'totalAdmin', 'totalMitra', 'totalClient'));   
    }
}
