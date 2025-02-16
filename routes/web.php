<?php

use App\Http\Controllers\BackEnd\v1\Admins\AdminCategoryController;
use App\Http\Controllers\BackEnd\v1\AuthController as BackendAuthController;
use App\Http\Controllers\BackEnd\v1\Mitras\MitraProductController;
use App\Http\Controllers\BackEnd\v1\Superadmins\AdminController;
use App\Http\Controllers\Views\Admin\AdminDashboardController;
use App\Http\Controllers\Views\Admin\AdminKelolaKategoriController;
use App\Http\Controllers\Views\Admins\AdminHomeController;
use App\Http\Controllers\Views\AuthController as ViewAuthController;
use App\Http\Controllers\views\Clients\ClientAboutUsController;
use App\Http\Controllers\Views\Clients\ClientArticleController;
use App\Http\Controllers\Views\Clients\ClientDetailPacketController;
use App\Http\Controllers\Views\Clients\ClientHomeController;
use App\Http\Controllers\Views\Clients\ClientProfileController;
use App\Http\Controllers\Views\Clients\ClientVendorsController;
use App\Http\Controllers\Views\LandingController;
use App\Http\Controllers\Views\Mitra\MitraCreateVendorController;
use App\Http\Controllers\Views\Mitra\MitraDashboardController;
use App\Http\Controllers\Views\Mitra\MitraKelolaProdukController;
use App\Http\Controllers\Views\Superadmin\SuperadminDashboardController;
use App\Http\Controllers\Views\Superadmin\SuperadminKelolaAdminController;
use App\Http\Controllers\Views\Superadmin\SuperadminKelolaClientController;
use App\Http\Controllers\Views\Superadmin\SuperadminKelolaMitraController;
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

// superadmin route
Route::group(['prefix' => 'superadmins', 'middleware' => ['can:superadmin']], function() {
    Route::get('/superadmin/dashboard', [SuperadminDashboardController::class, 'index'])->name('superadmin.home');
    Route::get('/superadmin/kelola/admin', [SuperadminKelolaAdminController::class, 'index'])->name('superadmin.kelola.admin');
    Route::get('/superadmin/kelola/mitra', [SuperadminKelolaMitraController::class, 'index'])->name('superadmin.kelola.mitra');
    Route::get('/superadmin/kelola/client', [SuperadminKelolaClientController::class, 'index'])->name('superadmin.kelola.client');

    Route::post('/superadmin/add/admin', [AdminController::class, 'makeAdmin'])->name('superadmin.make.admin');
});

// admin route
Route::group(['prefix' => 'admins', 'middleware' => ['can:admin']], function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.home');
    Route::get('/admin/kelola/kategori', [AdminKelolaKategoriController::class, 'index'])->name('admin.kelola.kategori');
    Route::group(['prefix' => 'categories', 'controller' => AdminCategoryController::class], function () {
        Route::post('/{id?}', 'storeCategory')->name('be.category.store');
        Route::delete('/{id}', 'deleteCategory')->name('be.category.delete');
    });
});

// mitra route
Route::group(['prefix' => 'mitras', 'middleware' => ['can:mitra']], function () {
    Route::get('/produk/{id}/data', [MitraProductController::class, 'dataById'])->name('mitra.produk.data');
    Route::post('/mitra/store/produk/{id?}', [MitraProductController::class, 'storeProduct'])->name('mitra.store.produk');
    Route::get('/mitra/dashboard', [MitraDashboardController::class, 'index'])->name('mitra.home');
    Route::get('/mitra/kelola/produk', [MitraKelolaProdukController::class, 'index'])->name('mitra.kelola.produk');
    Route::get('/mitra/delete/produk/{id}', [MitraProductController::class, 'deleteProduct'])->name('mitra.delete.produk');
    Route::get('/mitra/make/vendor', [MitraCreateVendorController::class, 'index'])->name('mitra.tambah.vendor.show');
    Route::post('/mitra/store/vendor', [MitraCreateVendorController::class, 'storeVendor'])->name('mitra.store.vendor');

});

// client route
Route::get('/', [LandingController::class, 'landing'])->name('client.home');
Route::get('/detailPacket', [ClientDetailPacketController::class, 'detailPacket'])->name('detailPacket');
Route::get('/article', [ClientArticleController::class, 'index'])->name('article');
Route::get('/aboutUs', [ClientAboutUsController::class, 'index'])->name('aboutUs');
Route::get('/vendors/{category}', [ClientVendorsController::class, 'index'])->name('vendors');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [ClientProfileController::class,'profile'])->name('profile');
});
