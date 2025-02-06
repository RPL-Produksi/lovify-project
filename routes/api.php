<?php

use App\Http\Controllers\BackEnd\v1\Admins\AdminCategoryController;
use App\Http\Controllers\BackEnd\v1\Admin\AdminPacketController;
use App\Http\Controllers\BackEnd\v1\AuthController;
use App\Http\Controllers\Backend\v1\CategoryController;
use App\Http\Controllers\BackEnd\v1\Client\ClientCategoryController;
use App\Http\Controllers\Backend\v1\Client\ClientPlanningController;
use App\Http\Controllers\BackEnd\v1\Client\ClientProductController;
use App\Http\Controllers\BackEnd\v1\Mitra\MitraProductController;
use App\Http\Controllers\Backend\v1\PacketController;
use App\Http\Controllers\Backend\v1\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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
    });
    // Admin
    Route::group(['prefix' => 'admins', 'middleware' => ['can:admin']], function () {
        Route::group(['prefix' => 'categories', 'controller' => AdminCategoryController::class], function () {
            Route::post('/{id?}', 'storeCategory');
            Route::delete('/{id}', 'deleteCategory');
        });
    });

    Route::group(['prefix' => 'mitra', 'middleware' => 'auth:sanctum'], function () {
        Route::group(['prefix' => 'product', 'controller' => MitraProductController::class], function () {
            Route::post('/store/{id?}', 'store');
            Route::delete('/{id}', 'delete');
        });
    });

    Route::prefix('client')->group(function () {
        Route::group(['prefix' => 'category', 'controller' => ClientCategoryController::class], function () {
            Route::get('/', 'getCategory');
            Route::get('/{id}/products', 'getProductByCategory');
        });

        Route::group(['prefix' => 'product', 'controller' => ClientProductController::class], function () {
            Route::get('/', 'getProduct');
            Route::get('/{id}', 'getProduct');
        });
    });
});

Route::fallback(function () {
    return response()->json([
        'message' => 'error',
        'status' => 'no path found',
    ], 404);
});
