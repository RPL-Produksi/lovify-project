<?php

use App\Http\Controllers\API\v1\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->controller(AuthController::class, function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
        Route::post('logout', 'logout')->middleware(['auth:web']);
        Route::post('admin', 'makeAdmin')->middleware(['can:superadmin']);
    });
});