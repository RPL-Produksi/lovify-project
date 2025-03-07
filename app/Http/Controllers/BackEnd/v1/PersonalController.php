<?php

namespace App\Http\Controllers\BackEnd\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PersonalController extends Controller
{
    public function getUser(Request $request)
    {
        $user = $request->user();
        $response = [
            'fullname' => $user->fullname,
            'username' => $user->username,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'email_verified' => $user->email_verified,
            'phone_verified' => $user->phone_verified,
            'avatar' => $user->avatar,
            'role' => $user->role
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Get User Successfully.',
            'data' => $response,
        ]);
    }

    public function changeProfile(Request $request)
    {
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'username' => ['nullable', 'string', 'unique:users,username,' . $user->id],
            'email' => ['nullable', 'email', 'unique:users,email,' . $user->id],
            'phone_number' => ['nullable', 'unique:users,phone_number,' . $user->id],
            'avatar' => ['nullable', 'file', 'mimes:jpg,png,jpeg']
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()
                ], 400);
            }

            return redirect()->back()->withErrors($validator->errors());
        }

        $data = array_filter($request->all(), function ($value) {
            return !is_null($value);
        });

        if (isset($data['email']) && $data['email'] != $user->email) {
            $data['email_verified'] = false;
        }

        if (isset($data['phone_number']) && $data['phone_number'] != $user->phone_number) {
            $data['phone_verified'] = false;
        }

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $storedFile = $file->storeAs('avatars/' . ($request->username ?? $user->username), $file->hashName());
            $filePath = Storage::url($storedFile);
            $data['avatar'] = $filePath;
        } else {
            unset($data['avatar']);
        }

        $user->update($data);
        $response = [
            'fullname' => $user->fullname,
            'username' => $user->username,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'email_verified' => $user->email_verified,
            'phone_verified' => $user->phone_verified,
            'avatar' => $user->avatar ?? asset('avatars/default.png'),
            'role' => $user->role
        ];

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Profile Change Successfully.',
                'data' => $response
            ], 200);
        }

        return redirect()->back()->with('success', 'Profile changes successfully');
    }


    public function deleteAvatar(Request $request)
    {
        $user = $request->user();

        if ($user->avatar) {
            $avatarPath = str_replace('/storage', 'public', $user->avatar);
            if (Storage::exists($avatarPath)) {
                Storage::delete($avatarPath);
            }

            $user->update(['avatar' => null]);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Avatar successfully deleted.',
                'avatar' => asset('avatars/default.png')
            ], 200);
        }

        return redirect()->back()->with('success', 'Avatar deleted successfully.');
    }

    public function changePassword(Request $request)
    {
        $currentUser = $request->user();

        $user = $request->user_id ? User::find($request->user_id) : $currentUser;

        if (!$user) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found.'
                ], 404);
            }
            return redirect()->back()->withErrors(['user_id' => 'User not found.']);
        }

        if ($request->user_id && $currentUser->role !== 'superadmin') {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized.'
                ], 403);
            }
            return redirect()->back()->withErrors(['error' => 'Unauthorized.']);
        }

        $rules = [
            'new_password' => ['required', 'string', 'min:8', 'confirmed']
        ];

        if (!$request->user_id || $request->user_id == $currentUser->id) {
            $rules['old_password'] = ['required', 'string'];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()
                ], 400);
            }
            return redirect()->back()->withErrors($validator->errors());
        }

        if (!$request->user_id || $request->user_id == $currentUser->id) {
            if (!Hash::check($request->old_password, $user->password)) {
                if ($request->wantsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Old Password is incorrect.'
                    ], 400);
                }
                return redirect()->back()->withErrors(['old_password' => 'Old Password is incorrect.']);
            }
        }

        $user->update([
            'password' => bcrypt($request->new_password)
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Password changed successfully.'
            ], 200);
        }

        if ($currentUser->role == 'client') {
            return redirect()->route('client.home')->with('success', 'Password changed successfully.');
        }

        return redirect()->back()->with('success', 'Password changed successfully.');
    }
}
