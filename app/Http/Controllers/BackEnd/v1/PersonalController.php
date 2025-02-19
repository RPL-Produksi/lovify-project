<?php

namespace App\Http\Controllers\BackEnd\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonalController extends Controller
{
    public function getUser(Request $request)
    {
        $user = $request->user();
        
        // $table->string('fullname');
        // $table->string('username')->unique();
        // $table->string('password');
        // $table->string('email')->unique();
        // $table->string('number_phone')->nullable();
        // $table->tinyInteger('phone_verified')->default(0);
        // $table->tinyInteger('email_verified')->default(0);
        // $table->string('email_verification_token')->nullable();
        // $table->string('phone_verification_token')->nullable();
        // $table->string('avatar')->nullable();
        // $table->enum('role', ['client', 'mitra'])->default('client');
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
            'email' => ['nullable', 'email ']
        ]);
    }
}
