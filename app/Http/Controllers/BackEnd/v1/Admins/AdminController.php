<?php

namespace App\Http\Controllers\Backend\v1\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // public function makeAdmin(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'fullname' => ['required', 'string', 'max:255'],
    //         'username' => ['required', 'string', 'max:255', 'unique:users,username'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^[a-zA-Z0-9\-_]+$/'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
    //         'number_phone' => ['nullable', 'string', 'max:255', 'unique:users,number_phone'],
    //         'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
    //     ]);

    //     if ($validator->fails()) {
    //         if ($request->wantsJson()) {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => $validator->errors(),
    //             ], 400);
    //         }

    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    // }
}
