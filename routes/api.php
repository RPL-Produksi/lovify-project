<?php

use App\Http\Controllers\BackEnd\v1\Admin\AdminCategoryController;
use App\Http\Controllers\BackEnd\v1\Admin\AdminPacketController;
use App\Http\Controllers\BackEnd\v1\AuthController;
use App\Http\Controllers\Backend\v1\CategoryController;
use App\Http\Controllers\BackEnd\v1\Mitra\MitraProductController;
use App\Http\Controllers\Backend\v1\PacketController;
use App\Http\Controllers\Backend\v1\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'user', 'middleware' => ['auth:sanctum']], function () {
    Route::get('/', function (Request $request) {
        return $request->user();
    });
    Route::post('/profile', [ProfileController::class, 'updateProfile']);
});

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
    // Umum
    Route::get('/categories', [CategoryController::class, 'getCategory']);
    Route::get('/packets', [PacketController::class, 'getPackets']);
    // Admin
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
    // Mitra
    Route::prefix('mitra')->group(function () {
        Route::group(['middleware' => ['auth:sanctum', 'can:mitra', 'can:verified'], 'prefix' => 'products', 'controller' => MitraProductController::class], function () {
            Route::post('/{id?}', 'storeProduct');
            Route::delete('/{slug}', 'deleteProduct');
        });
    });
});
