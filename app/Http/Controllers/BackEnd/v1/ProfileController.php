<?php

namespace App\Http\Controllers\Backend\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => ['string', 'max:255'],
            'username' => ['string', 'max:255', 'unique:users,username,' . Auth::id()],
            'email' => ['string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            'number_phone' => ['nullable', 'string', 'max:255'],
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

        $defaultAvatar = env('PROFILE_DEFAULT_IMAGE');

        $user = User::find(Auth::id());
        $isPhoneSame = $user->number_phone == $request->number_phone;

        $user->fullname = $request->fullname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->number_phone = $request->number_phone;
        $user->phone_verified = !$isPhoneSame ?? 0;

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = $user->username . '.' . $avatar->getClientOriginalExtension();
            $path = $avatar->storeAs('avatars/' . $user->username, $avatarName, 'public');
            $user->avatar = $path;
        } else {
            $user->avatar = null;
        }

        $user->save();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success', 
                'message' => 'Profile updated successfully',
                'data' => [
                    'fullname' => $user->fullname,
                    'username' => $user->username,
                    'email' => $user->email,
                    'number_phone' => $user->number_phone,
                    'avatar' => $user->avatar != null ? asset(Storage::url($user->avatar)) : asset(Storage::url($defaultAvatar)),
                ]
            ]);
        }

        return response()->json(['message' => 'Profile updated successfully']);
    }
}
