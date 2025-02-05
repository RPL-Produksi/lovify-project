<?php

namespace App\Http\Controllers\Backend\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required',
        ]);

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $admin = $request->has('admin') ? true : false;

        if (Auth::attempt([$loginType => $request->login, 'password' => $request->password])) {
            $user = Auth::user();

            if ()
        }
    }
}
