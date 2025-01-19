<?php

use App\Http\Controllers\BackEnd\v1\Admin\AdminCategoryController;
use App\Http\Controllers\BackEnd\v1\Admin\AdminPacketController;
use App\Http\Controllers\BackEnd\v1\AuthController;
use App\Http\Controllers\BackEnd\v1\Mitra\MitraProductController;
use App\Http\Controllers\View\Home\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function () {
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
    Route::middleware('auth')->group(function () {
        Route::post('/logout', 'logout')->name('logout');
        Route::post('/admin', 'makeAdmin')->name('makeAdmin')->can('superadmin');
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
Route::get('/home', [HomeController::class, 'home'])->name('home');
