<?php

namespace App\Http\Controllers\BackEnd\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Stringable;

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
        $data['email_verification_token'] = Str::random(64);
        $data['phone_verification_token'] = Str::random(64);
        $data['email_verification_expire'] = now()->addMinutes(10);
        $data['phone_verification_expire'] = now()->addMinutes(10);
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $storedFile = $file->storeAs('avatars/' . $request->username, $file->hashName());
            $filePath = Storage::url($storedFile);
            $data['avatar'] = $filePath;
        } else {
            $data['avatar'] = null;
        }

        $user = User::create($data);
        $verificationUrlEmail = url("/auth/verify?id={$user->id}&type=email&token={$user->email_verification_token}");
        $user->notify(new VerifyEmailNotification($verificationUrlEmail));
        $verificationUrlPhone = url("/auth/verify?id={$user->id}&type=phone&token={$user->phone_verification_token}");
        Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN'),
        ])->post('https://api.fonnte.com/send', [
            'target' => $user->phone_number,
            'message' => "Link for verification Phone Number:\n" .  $verificationUrlPhone,
            'countryCode' => '62',
        ]);

        if ($request->wantsJson()) {
            $token = $user->createToken('auth_token')->plainTextToken;
            $response = $user;
            $response['token'] = $token;
            $response['avatar'] = $user->avatar == null ? asset('avatars/default.png') : $user->avatar;
            return response()->json([
                'status' => 'success',
                'message' => 'User Created Successfully. Please check your email for verification.',
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
    
    public function resend(Request $request)
    {
        $user = $request->user();
        $type = $request->query('type');
        $status = '';
        $message = '';
        $httpCode = 200;
    
        if ($type == 'email') {
            if ($user->email_verified) {
                $status = 'error';
                $message = 'Email already verified.';
                $httpCode = 400;
            }

            if (now()->greaterThan($user->email_token_expire)) {
                $user->update([
                    'email_verification_token' => Str::random(64),
                    'email_token_expire' => now()->addMinutes(10),
                ]);
            }

            $verificationUrl = url("/auth/verify?id={$user->id}&type=email&token={$user->email_verification_token}");
            $user->notify(new VerifyEmailNotification($verificationUrl));

            $status = 'success';
            $message = 'Verification email sent.';
            $httpCode = 200;
        }

        if ($type == 'phone') {
            if ($user->phone_verified) {
                $status = 'error';
                $message = 'Phone Number already verified.';
                $httpCode = 400;
            }
            
            if (now()->greaterThan($user->phone_token_expire)) {
                $user->update([
                    'phone_verification_token' => Str::random(64),
                    'phone_token_expire' => now()->addMinutes(10),
                ]);
            }

            $verificationUrl = url("/auth/verify?id={$user->id}&type=phone&token={$user->phone_verification_token}");
            $response = Http::withHeaders([
                'Authorization' => env('FONNTE_TOKEN'),
            ])->post('https://api.fonnte.com/send', [
                'target' => $user->phone_number,
                'message' => "Link for verification Phone Number:\n" .  $verificationUrl,
                'countryCode' => '62',
            ]);

            if ($response->successful()) {
                $status = 'success';
                $message = 'Verification Phone Number sent.';
                $httpCode = 200;
            } else {
                $status = 'error';
                $message = 'Send Verification failed';
                $httpCode = 400;
            }
        }

        if ($request->wantsJson()) {
            return response()->json([
                'status' => $status,
                'message' => $message
            ], $httpCode);
        }

        return redirect()->back()->with(['status' => $status, 'message' => $message]);
    }    
}
