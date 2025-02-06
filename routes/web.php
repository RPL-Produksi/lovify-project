<?php

use App\Http\Controllers\Backend\v1\AuthController as BackendAuthController;
use App\Http\Controllers\View\AuthController as ViewAuthController;
use App\Http\Controllers\view\client\ClientAboutUsController;
use App\Http\Controllers\View\Client\ClientArticleController;
use App\Http\Controllers\View\Client\ClientDetailPacketController;
use App\Http\Controllers\View\Client\ClientHomeController;
use App\Http\Controllers\View\LandingController;
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
        Route::post('/logout', 'logout')->name('be.logout');
    });
});

// client route
Route::get('/', [LandingController::class, 'landing'])->name('landing');
Route::get('/detailPacket', [ClientDetailPacketController::class, 'detailPacket'])->name('detailPacket');
Route::get('/article', [ClientArticleController::class, 'index'])->name('article');
Route::get('/aboutUs', [ClientAboutUsController::class, 'index'])->name('aboutUs');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [ClientHomeController::class, 'home'])->name('home');
});
