<?php

use App\Http\Controllers\Backend\v1\Admins\AdminCategoryController;
use App\Http\Controllers\Backend\v1\AuthController as BackendAuthController;

use App\Http\Controllers\Views\Admin\AdminDashboardController;

use App\Http\Controllers\Views\Admins\AdminHomeController;
use App\Http\Controllers\Views\AuthController as ViewAuthController;
use App\Http\Controllers\views\Clients\ClientAboutUsController;
use App\Http\Controllers\Views\Clients\ClientArticleController;
use App\Http\Controllers\Views\Clients\ClientDetailPacketController;
use App\Http\Controllers\Views\Clients\ClientHomeController;
use App\Http\Controllers\Views\Clients\ClientProfileController;
use App\Http\Controllers\Views\Clients\ClientVendorsController;
use App\Http\Controllers\Views\LandingController;
use App\Http\Controllers\Views\Superadmin\SuperadminDashboardController;
use App\Http\Controllers\Views\Superadmin\SuperadminKelolaAdminController;
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

// Client Admin
Route::group(['prefix' => 'admins', 'middleware' => ['can:admin']], function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.home');
    Route::group(['prefix' => 'categories', 'controller' => AdminCategoryController::class], function () {
        Route::post('/{id?}', 'storeCategory')->name('be.category.store');
        Route::delete('/{id}', 'deleteCategory')->name('be.category.delete');
    });
});
Route::group(['middleware' => 'auth'], function () {
});

Route::get('/superadmin/dashboard', [SuperadminDashboardController::class, 'index'])->name('superadmin.home');
Route::get('/superadmin/kelola/admin', [SuperadminKelolaAdminController::class, 'index'])->name('superadmin.kelola.admin');

// Umum
Route::get('/', [LandingController::class, 'landing'])->name('client.home');
Route::get('/detailPacket', [ClientDetailPacketController::class, 'detailPacket'])->name('detailPacket');
Route::get('/article', [ClientArticleController::class, 'index'])->name('article');
Route::get('/aboutUs', [ClientAboutUsController::class, 'index'])->name('aboutUs');
Route::get('/vendors/{category}', [ClientVendorsController::class, 'index'])->name('vendors');

// middleware auth
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [ClientProfileController::class,'profile'])->name('profile');
});
