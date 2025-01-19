<?php

use App\Http\Controllers\BackEnd\v1\Admin\AdminCategoryController;
use App\Http\Controllers\BackEnd\v1\Admin\AdminPacketController;
use App\Http\Controllers\BackEnd\v1\AuthController as APIAuthController;
use App\Http\Controllers\BackEnd\v1\Mitra\MitraProductController;
use App\Http\Controllers\View\AuthController as ViewAuthController;
use App\Http\Controllers\View\Client\HomeController;
use App\Http\Controllers\View\Client\LandingController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::group(['controller' => ViewAuthController::class], function () {
        Route::get('/login', 'login')->name('login');
        Route::get('/register', 'register')->name('register');
    });
    Route::group(['controller' => APIAuthController::class], function () {
        Route::post('/register', 'register')->name('post.register');
        Route::post('/login', 'login')->name('post.login');
        Route::middleware('auth')->group(function () {
            Route::post('/logout', 'logout')->name('logout');
            Route::post('/admin', 'makeAdmin')->name('makeAdmin')->can('superadmin');
        });
    });
});
Route::prefix('admins')->group(function () {
    Route::group(['middleware' => ['auth', 'can:admin'], 'prefix' => 'categories', 'controller' => AdminCategoryController::class], function () {
        Route::post('/{id?}', 'storeCategory')->name('storeCategory');
        Route::delete('/{id}', 'deleteCategory')->name('deleteCategory');
    });
    Route::group(['middleware' => ['auth', 'can:admin'], 'prefix' => 'packets', 'controller' => AdminPacketController::class], function () {
        Route::post('/{id?}', 'storePacket')->name('storePacket');
        Route::delete('/{id}', 'deletePacket')->name('deletePacket');
    });
});
Route::prefix('mitras')->group(function () {
    Route::group(['middleware' => ['auth', 'can:mitra'], 'prefix' => 'products', 'controller' => MitraProductController::class], function () {
        Route::post('/{id?}', 'storeProduct')->name('storeProduct');
        Route::delete('/{slug}', 'deleteProduct')->name('deleteProduct');
    });
});
Route::get('/', [LandingController::class, 'landing'])->name('landing');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'home'])->name('home');
});
