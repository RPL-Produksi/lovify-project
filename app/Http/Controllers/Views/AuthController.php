<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
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

    public function verify(Request $request)
    {
        $id = $request->query('id');
        $token = $request->query('token');
        $type = $request->query('type');
        $user = User::findOrFail($id);
        $status = 'error';
        $message = 'Invalid verification link.';
    
        if ($type == 'email') {
            if ($user->email_verified) {
                $status = 'error';
                $message = 'Email already verified.';
            }
            
            if ($token != $user->email_verification_token) {
                $status = 'error';
                $message = 'Invalid verification link.';
            }

            if (Carbon::parse($user->email_token_expire)->greaterThan(now())) {
                $status = 'error';
                $message = 'Verification link expired';
                $httpCode = 400;
            }
            
            $user->update([
                'email_verified' => 1,
                'email_verification_token' => null,
                'email_token_expire' => null,
            ]);
            $status = 'success';
            $message = 'Email successfully verified.';
        }
        
        if ($type == 'phone') {
            if ($user->phone_verified) {
                $status = 'error';
                $message = 'Phone Number already verified.';
            }

            if ($token != $user->phone_verification_token) {
                $status = 'error';
                $message = 'Invalid verification link.';
            }

            if (Carbon::parse($user->phone_token_expire)->greaterThan(now())) {
                $status = 'error';
                $message = 'Verification link expired';
                $httpCode = 400;
            }

            $user->update([
                'phone_verified' => 1,
                'phone_verification_token' => null,
                'phone_token_expire' => null,
            ]);
            $status = 'success';
            $message = 'Phone Number successfully verified';
        }

        return view('pages.auth.verify', compact('status', 'message'));
    }
}
