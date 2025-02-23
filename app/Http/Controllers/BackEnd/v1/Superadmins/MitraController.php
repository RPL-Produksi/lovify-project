<?php

namespace App\Http\Controllers\BackEnd\v1\Superadmins;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MitraController extends Controller
{
    public function makeMitra(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^[a-zA-Z0-9\-_]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone_number' => ['nullable', 'string', 'max:255', 'unique:users,phone_number'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors(),
                ], 400);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        $data['role'] = 'mitra';

        if ($request->hasFile('avatar')) {
            $filename = Str::uuid() . '.' . $request->file('avatar')->getClientOriginalExtension();
            $storedFile = $request->file('avatar')->storeAs('avatars/' . $request->username, $filename);
            $filePath = Storage::url($storedFile);
            $data['avatar'] = $filePath;
        } else {
            $data['avatar'] = null;
        }

        $user = User::create($data);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'User Created Successfully',
                'data' => $user,
            ], 200);
        }

        return redirect()->back()->with('success', 'User Created Successfully');
    }
}
