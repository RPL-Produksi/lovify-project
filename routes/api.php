<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackEnd\v1\AuthController;
use App\Http\Controllers\Backend\v1\CategoryController;
use App\Http\Controllers\BackEnd\v1\Admins\AdminCategoryController;
use App\Http\Controllers\BackEnd\v1\Mitras\MitraProductController;
use App\Http\Controllers\BackEnd\v1\Clients\ClientCategoryController;
use App\Http\Controllers\BackEnd\v1\Clients\ClientProductController;
use App\Http\Controllers\Backend\v1\Mitras\MitraVendorController;
use App\Http\Controllers\Backend\v1\ProductController;

Route::group(['prefix' => 'user', 'middleware' => ['auth:sanctum']], function () {
    Route::get('/', function (Request $request) {
        return $request->user();
    });
});

Route::prefix('v1')->group(function () {
    Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function () {
        Route::post('/register', 'register');
        Route::post('/login', 'login');
        Route::post('/logout', 'logout')->middleware('auth:sanctum');
    });
    // Umum
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('/categories/{id?}', [CategoryController::class, 'getCategory']);
        Route::get('/products/{slug?}', [ProductController::class, 'getProducts']);
    });
    // Admin
    Route::group(['prefix' => 'admins', 'middleware' => ['auth:sanctum', 'can:admin']], function () {
        Route::group(['prefix' => 'categories', 'controller' => AdminCategoryController::class], function () {
            Route::post('/{id?}', 'storeCategory');
            Route::delete('/{id}', 'deleteCategory');
        });
    });
    // Mitra
    Route::group(['prefix' => 'mitras', 'middleware' => ['auth:sanctum', 'can:mitra']], function () {
        Route::group(['prefix' => 'products', 'controller' => MitraProductController::class], function () {
            Route::post('/{id?}', 'storeProduct');
            Route::delete('/{id}', 'deleteProduct');
        });
        Route::group(['prefix' => 'vendors', 'controller' => MitraVendorController::class], function () {
            Route::post('/{id?}', 'storeVendor');
            Route::delete('/{id}', 'deleteVendor');
        });
    });

    Route::group(['prefix' => 'clients', 'middleware' => ['auth:sanctum', 'can:client']], function () {
    });
});

Route::fallback(function () {
    return response()->json([
        'message' => 'error',
        'status' => 'no path found',
    ], 404);
});
