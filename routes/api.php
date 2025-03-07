<?php

use App\Http\Controllers\BackEnd\v1\Admins\AdminVendorController;
use App\Http\Controllers\BackEnd\v1\Mitras\MitraOrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackEnd\v1\AuthController;
use App\Http\Controllers\BackEnd\v1\Admins\AdminCategoryController;
use App\Http\Controllers\BackEnd\v1\Admins\AdminLocationController;
use App\Http\Controllers\BackEnd\v1\CategoryController;
use App\Http\Controllers\BackEnd\v1\Clients\ClientOrderController;
use App\Http\Controllers\BackEnd\v1\Clients\ClientPlanningController;
use App\Http\Controllers\BackEnd\v1\Clients\ClientTransactionController;
use App\Http\Controllers\BackEnd\v1\Mitras\MitraProductController;
use App\Http\Controllers\BackEnd\v1\Mitras\MitraVendorController;
use App\Http\Controllers\BackEnd\v1\PersonalController;
use App\Http\Controllers\BackEnd\v1\PlanningController;
use App\Http\Controllers\BackEnd\v1\ProductController;
use App\Http\Controllers\BackEnd\v1\VendorController;
use Illuminate\Support\Facades\Validator;


Route::prefix('v1')->group(function () {
    Route::group(['prefix' => 'user', 'middleware' => ['auth:sanctum'], 'controller' => PersonalController::class], function () {
        Route::get('/', 'getUser');
        Route::post('/', 'changeProfile');
        Route::post('/password', 'changePassword');
    });
    Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function () {
        Route::post('/register', 'register');
        Route::post('/login', 'login');
        Route::post('/resend-verification', 'resend');
        Route::post('/logout', 'logout')->middleware('auth:sanctum');
    });
    // Umum
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('/categories/{id?}', [CategoryController::class, 'getCategory']);
        Route::get('/products/{id?}', [ProductController::class, 'getProducts']);
        Route::get('/vendors/{id?}', [VendorController::class, 'getVendors']);
        Route::get('/plannings/{id?}', [PlanningController::class, 'getPlanning']);
    });
    // Admin
    Route::group(['prefix' => 'admins', 'middleware' => ['auth:sanctum', 'can:admin']], function () {
        Route::group(['prefix' => 'categories', 'controller' => AdminCategoryController::class], function () {
            Route::post('/{id?}', 'storeCategory');
            Route::delete('/{id}', 'deleteCategory');
        });
        Route::group(['prefix' => 'locations', 'controller' => AdminLocationController::class], function () {
            Route::post('/', 'storeLocation');
            Route::delete('/{id}', 'deleteLocation');
        });
        Route::group(['prefix' => 'vendors', 'controller' => AdminVendorController::class], function () {
            Route::post('/{id}', 'verifyVendor');
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
        Route::group(['prefix' => 'orders', 'controller' => MitraOrderController::class], function () {
            Route::get('/', 'orderList');
            Route::post('/{id}', 'updateProductProgress');
        });
    });
    // Client
    Route::group(['prefix' => 'clients', 'middleware' => ['auth:sanctum', 'can:client']], function () {
        Route::group(['prefix' => 'plannings', 'controller' => ClientPlanningController::class], function () {
            Route::get('/', 'getPlannings');
            Route::post('/{id?}', 'storePlanning');
            Route::delete('/{id}', 'deletePlanning');
        });
        Route::group(['prefix' => 'orders', 'middleware' => ['can:email_verified, can:phone_verified'], 'controller' => ClientOrderController::class], function () {
            Route::get('/', 'getOrders');
            Route::post('/{id}', 'storeOrder');
        });
        Route::group(['prefix' => 'transactions', 'controller' => ClientTransactionController::class], function () {
            Route::get('/', 'getTransactions');
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

Route::post('/transactions/notification', [ClientTransactionController::class, 'notification']);
