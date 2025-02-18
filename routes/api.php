<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackEnd\v1\AuthController;
use App\Http\Controllers\BackEnd\v1\Admins\AdminCategoryController;
use App\Http\Controllers\Backend\v1\CategoryController;
use App\Http\Controllers\BackEnd\v1\Clients\ClientOrderController;
use App\Http\Controllers\Backend\v1\Clients\ClientPlanningController;
use App\Http\Controllers\BackEnd\v1\Clients\ClientTransactionController;
use App\Http\Controllers\BackEnd\v1\Mitras\MitraProductController;
use App\Http\Controllers\Backend\v1\Mitras\MitraVendorController;
use App\Http\Controllers\Backend\v1\PlanningController;
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
        Route::get('/plannings/{id?}', [PlanningController::class, 'getPlanning']);
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
    // Client
    Route::group(['prefix' => 'clients', 'middleware' => ['auth:sanctum', 'can:client']], function () {
        Route::group(['prefix' => 'plannings', 'controller' => ClientPlanningController::class], function () {
            Route::post('/{id?}', 'storePlanning');
            Route::delete('/{id}', 'deletePlanning');
        });
        Route::group(['prefix' => 'orders', 'middleware' => ['can:email_verified, can:phone_verified'], 'controller' => ClientOrderController::class], function () {
            Route::post('/{id}', 'storeOrder');
        });
        Route::group(['prefix' => 'transactions', 'controller' => ClientTransactionController::class], function () {
            Route::post('/{id}', 'storePayment');
        });
    });
});

Route::fallback(function () {
    return response()->json([
        'message' => 'error',
        'status' => 'no path found',
    ], 404);
});
