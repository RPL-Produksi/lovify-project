<?php

use App\Http\Controllers\API\V1\Admin\AdminCategoryController;
use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\Mitra\MitraProductController;
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
        Route::group(['middleware' => ['auth:sanctum', 'can:admin'], 'prefix' => 'category', 'controller' => AdminCategoryController::class], function () {
            Route::get('/', 'getCategory');
            Route::get('/{id}', 'getCategoryById');
            Route::post('/store/{id?}', 'storeCategory');
            Route::delete('/delete/{id}', 'deleteCategory');
        });
    });

    Route::prefix('mitra')->group(function () {
        Route::group(['middleware' => ['auth:sanctum', 'can:mitra'], 'prefix' => 'product', 'controller' => MitraProductController::class], function () {
            Route::get('/', 'getProducts');
            Route::get('/{slug}', 'getProductsBySlug');
            Route::post('/store/{id?}', 'storeProduct');
            Route::delete('/delete/{slug}', 'deleteProduct');
        });
    });
});
