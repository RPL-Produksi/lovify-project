<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'username' => 'required|min:3|unique:users,username',
            'password' => 'required|confirmed|min:6',
            'email' => 'required|email|unique:users,email',
            'number_phone' => 'required|unique:users,phone',
        ]);

        if ($validator->fails()) {
            if ($this->isJson($request)) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors(),
                ], 400);
            }

            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        $user = new User();
        $user->fullname = $request->fullname;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->number_phone = $request->number_phone;
        $user->role = $request->role;
        $user->save();

        if ($this->isJson($request)) {
            return response()->json([
                'status' => 'success',
                'message' => 'User registered successfully',
                'data' => $user,
            ], 201);
        }

        return redirect()->route('login')->with('success', 'User registered successfully');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->isJson($request)) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors(),
                ], 400);
            }

            return redirect()->back()->withInput($request->only('login'))->withErrors($validator);
        }

        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$fieldType => $request->login, 'password' => $request->password])) {
            $user = Auth::user();

            if ($request->isJson($request)) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Login successful',
                    'data' => [
                        'user' => $user,
                        'token' => $user->id->createToken('auth_token')->plainTextToken,
                    ],
                ], 200);
            }

            return $user->role == 'client' ? 'client' : 'mitra';
        }

        if ($request->isJson($request)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Username/Email or password is incorrect',
            ], 401);
        }

        return redirect()->back()->withInput($request->all())->withErrors([
            'login' => 'Username/Email or password is incorrect',
        ]);
    }
}
