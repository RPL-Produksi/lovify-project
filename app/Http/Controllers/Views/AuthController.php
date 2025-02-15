<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $isAdmin = False;
        if ($request->has('admin')) {
            $isAdmin = True;
        }
        return view('pages.auth.login', compact('isAdmin'));
    }

    public function register()
    {
        return view('pages.auth.register');
    }
}
