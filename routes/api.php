<?php

use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\Mitra\MitraProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function () {
        Route::post('/register', 'register');
        Route::post('/login', 'login');
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/logout', 'logout');
            Route::post('/admin', 'makeAdmin')->can('superadmin');
        });
    });

    Route::group(['prefix' => 'mitra', 'controller' => MitraProductController::class], function () {
        Route::post('/product/store/{id?}', 'store');
    });
});
