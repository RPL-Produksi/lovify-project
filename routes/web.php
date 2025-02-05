<?php

use App\Http\Controllers\BackEnd\v1\Admin\AdminCategoryController;
use App\Http\Controllers\BackEnd\v1\Admin\AdminPacketController;
use App\Http\Controllers\BackEnd\v1\AuthController as APIAuthController;
use App\Http\Controllers\BackEnd\v1\Mitra\MitraProductController;
use App\Http\Controllers\View\AuthController as ViewAuthController;
use App\Http\Controllers\view\client\ClientAboutUsController;
use App\Http\Controllers\View\Client\ClientArticleController;
use App\Http\Controllers\View\Client\ClientDetailArticleController;
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
});

// client route
Route::get('/', [LandingController::class, 'landing'])->name('landing');
Route::get('/detailPacket', [ClientDetailPacketController::class, 'detailPacket'])->name('detailPacket');
Route::get('/article', [ClientArticleController::class, 'index'])->name('article');
Route::get('/aboutUs', [ClientAboutUsController::class, 'index'])->name('aboutUs');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [ClientHomeController::class, 'home'])->name('home');
});
