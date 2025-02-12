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
            'username' => ['required', 'string', 'max:255', 'unique:users,username', 'regex:/^[a-zA-Z0-9\-_]+$/'],
            'password' => ['required', 'confirmed', 'string', 'min:8'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone_number' => ['required', 'string', 'max:15', 'unique:users,phone_number'],
            'role' => ['required', 'string', 'in:client,mitra'],
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
        $data['is_verified'] = $request->role == 'mitra' ? 0 : null;
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
            $response = $user;
            $response['token'] = $token;
            $response['avatar'] = $user->avatar == null ? asset('avatars/default.png') : $user->avatar;
            return response()->json([
                'status' => 'success',
                'message' => 'User Created Successfully',
                'data' => $response,
            ], 200);
        }

        Auth::login($user);
        $route = $user->role . '.home';
        return redirect()->route($route);
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

        $remember = $request->has('remember') ? true : false;
        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $admin = $request->has('admin') ? true : false;

        if (Auth::attempt([$loginType => $request->login, 'password' => $request->password], $remember)) {
            $user = Auth::user();

            if (($user->role == 'admin' || $user->role == 'superadmin') && !$admin) {
                Auth::logout();
                if ($request->wantsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Unauthorized',
                    ], 401);
                }

                return redirect()->back()->withErrors(['error' => 'Username or Password is Incorrect'])->withInput(['login']);
            }

            if ($request->wantsJson()) {
                $token = $request->user()->createToken('auth_token')->plainTextToken;
                $response = $user;
                $response['token'] = $token;
                $response['avatar'] = $user->avatar == null ? asset('avatars/default.png') : $user->avatar;
                return response()->json([
                    'status' => 'success',
                    'message' => 'Logged In Successfully',
                    'data' => $response
                ]);
            }

            $route = $user->role . '.home';
            return redirect()->route($route)->with('message', 'Logged In Successfully');
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
        if ($request->wantsJson()) {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Logged Out Successfully',
            ]);
        }

        Auth::logout();
        return redirect()->route('login');
    }
}
