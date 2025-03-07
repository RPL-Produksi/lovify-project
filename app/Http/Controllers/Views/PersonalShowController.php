<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalShowController extends Controller
{
    public function profile() {
        $user = Auth::user();
        return view('template-dashboard.layouts.profile', compact('user'));
    }

    public function changePassword() {
        $user = Auth::user();
        return view('template-dashboard.layouts.change-password',compact('user'));
    }

    public function changePasswordUser($id) {
        $user = Auth::user();
        $userChoose = User::find($id);
        return view('pages.superadmin.change-password-user.index',compact('userChoose', 'user'));
    }
}
