<?php

use App\Http\Controllers\Backend\v1\Admins\AdminCategoryController;
use App\Http\Controllers\Backend\v1\AuthController as BackendAuthController;
use App\Http\Controllers\Views\AuthController as ViewAuthController;
use App\Http\Controllers\views\Clients\ClientAboutUsController;
use App\Http\Controllers\Views\Clients\ClientArticleController;
use App\Http\Controllers\Views\Clients\ClientDetailPacketController;
use App\Http\Controllers\Views\Clients\ClientHomeController;
use App\Http\Controllers\Views\Clients\ClientProfileController;
use App\Http\Controllers\Views\LandingController;
use Illuminate\Support\Facades\Route;

// auth route
Route::prefix('auth')->group(function () {
    Route::group(['controller' => ViewAuthController::class], function () {
        Route::get('/login', 'login')->name('login');
        Route::get('/register', 'register')->name('register');
    });
    Route::group(['controller' => BackendAuthController::class], function () {
        Route::post('/register', 'register')->name('be.register');
        Route::post('/login', 'login')->name('be.login');
        Route::post('/logout', 'logout')->name('be.logout')->middleware('auth');
    });
});

// Admin
Route::group(['prefix' => 'admins', 'middleware' => ['can:admin']], function () {
    Route::group(['prefix' => 'categories', 'controller' => AdminCategoryController::class], function () {
        Route::post('/{id?}', 'storeCategory')->name('be.category.store');
        Route::delete('/{id}', 'deleteCategory')->name('be.category.delete');
    });
});

// client route
Route::get('/', [LandingController::class, 'landing'])->name('client.home');
Route::get('/detailPacket', [ClientDetailPacketController::class, 'detailPacket'])->name('detailPacket');
Route::get('/article', [ClientArticleController::class, 'index'])->name('article');
Route::get('/aboutUs', [ClientAboutUsController::class, 'index'])->name('aboutUs');

// middleware auth
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [ClientProfileController::class,'profile'])->name('profile');
});
