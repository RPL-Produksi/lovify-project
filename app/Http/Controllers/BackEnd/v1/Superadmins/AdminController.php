<?php

namespace App\Http\Controllers\BackEnd\v1\Superadmins;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function makeAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^[a-zA-Z0-9\-_]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone_number' => ['nullable', 'string', 'max:255', 'unique:users,phone_number'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'role' => ['required', 'in:admin,superadmin'],
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

    public function updateAdmin(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'fullname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:255'],
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

        $data = $request->only(['fullname', 'username', 'email', 'phone_number', 'role']);

        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar) {
                Storage::delete(str_replace('/storage/', '', $user->avatar));
            }

            $filename = Str::uuid() . '.' . $request->file('avatar')->getClientOriginalExtension();
            $storedFile = $request->file('avatar')->storeAs('avatars/' . $request->username, $filename);
            $filePath = Storage::url($storedFile);
            $data['avatar'] = $filePath;
        }

        $user->update($data);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'User Updated Successfully',
                'data' => $user,
            ], 200);
        }

        return redirect()->back()->with('success', 'User Updated Successfully');
    }

    public function deleteAdmin($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak ditemukan',
            ], 404);
        }

        if ($user->avatar) {
            Storage::delete(str_replace('/storage/', '', $user->avatar));
        }

        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User berhasil dihapus',
        ], 200);
    }
}
