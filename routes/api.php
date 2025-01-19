<?php

use App\Http\Controllers\BackEnd\v1\Admin\AdminCategoryController;
use App\Http\Controllers\BackEnd\v1\Admin\AdminPacketController;
use App\Http\Controllers\BackEnd\v1\AuthController;
use App\Http\Controllers\BackEnd\v1\Mitra\MitraProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::fallback(function () {
    return response()->json([
        'message' => 'error',
        'status' => 'no path found',
    ], 404);
});


Route::prefix('v1')->group(function () {
    Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function () {
        Route::post('/register', 'register');
        Route::post('/login', 'login');
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/logout', 'logout');
            Route::post('/admin', 'makeAdmin')->can('superadmin');
        });
    });
    Route::prefix('admin')->group(function () {
        Route::group(['middleware' => ['auth:sanctum', 'can:admin'], 'prefix' => 'categories', 'controller' => AdminCategoryController::class], function () {
            Route::post('/{id?}', 'storeCategory');
            Route::delete('/{id}', 'deleteCategory');
        });
        Route::group(['middleware' => ['auth:sanctum', 'can:admin'], 'prefix' => 'packets', 'controller' => AdminPacketController::class], function () {
            Route::post('/{id?}', 'storePacket');
            Route::delete('/{id}', 'deletePacket');
        });
    });
    Route::prefix('mitra')->group(function () {
        Route::group(['middleware' => ['auth:sanctum', 'can:mitra'], 'prefix' => 'products', 'controller' => MitraProductController::class], function () {
            Route::post('/{id?}', 'storeProduct');
            Route::delete('/{slug}', 'deleteProduct');
        });
    });
});
