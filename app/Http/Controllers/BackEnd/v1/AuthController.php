<?php

namespace App\Http\Controllers\Backend\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'password' => ['required', 'confirmed', 'string', 'min:8', 'regex:/^[a-zA-Z0-9\-_]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'number_phone' => ['nullable', 'string', 'max:15', 'unique:users,number_phone'],
            'role' => ['nullable', 'string', 'in:client,mitra'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors(),
                ], 400);
            }

            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $storedFile = $file->storeAs('avatars/' . $request->username, $file->hashName());
            $filePath = Storage::url($storedFile);
            $data['avatar'] = $filePath;
        } else {
            $data['avatar'] = null;
        }

        $user = User::create($data);

        if ($request->wantsJson()) {
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'status' => 'success',
                'message' => 'User Created Successfully',
                'data' => [
                    'token' => $token,
                    $user,
                ]
            ], 200);
        }

        Auth::login($user);
        // return redirect()->route($user->role, '.home');
        return true;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors(),
                ], 400);
            }
        }

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $admin = $request->has('admin') ? true : false;

        if (Auth::attempt([$loginType => $request->login, 'password' => $request->password])) {
            $user = Auth::user();

            if ($user->role == 'admin' && !$admin) {
                Auth::logout();
                if ($request->wantsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Unauthorized',
                    ], 401);
                }
            }

            if ($request->wantsJson()) {
                $token = $request->user()->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'status' => 'success',
                    'message' => 'Logged In Successfully',
                    'data' => [
                        'token' => $token,
                        $user,
                    ]
                ]);
            }

            // return redirect()->route($user->role, '.home');
            return true;
        }

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Username or Password is incorrect'
            ], 400);
        }

        return redirect()->back()->withErrors(['error' => 'Username or Password is incorrect'])->withInput(['username']);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Logged Out Successfully',
            ]);
        }

        // return redirect()->route('login');
        return true;
    }
}
