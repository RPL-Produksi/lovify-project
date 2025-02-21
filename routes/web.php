<?php

use App\Http\Controllers\BackEnd\v1\AuthController as BackendAuthController;
use App\Http\Controllers\BackEnd\v1\Admins\AdminCategoryController;
use App\Http\Controllers\BackEnd\v1\Clients\ClientPlanningController;
use App\Http\Controllers\BackEnd\v1\Mitras\MitraProductController;
use App\Http\Controllers\BackEnd\v1\Superadmins\AdminController;
use App\Http\Controllers\Views\Admin\AdminDashboardController;
use App\Http\Controllers\Views\Admin\AdminKelolaKategoriController;
use App\Http\Controllers\Views\Admins\AdminHomeController;
use App\Http\Controllers\views\Clients\ClientAboutUsController;
use App\Http\Controllers\Views\Clients\ClientArticleController;
use App\Http\Controllers\Views\Clients\ClientDetailPacketController;
use App\Http\Controllers\Views\Clients\ClientDetailProductController;
use App\Http\Controllers\Views\AuthController as ViewAuthController;
use App\Http\Controllers\Views\Clients\ClientHomeController;
use App\Http\Controllers\Views\Clients\ClientPlanningShowController;
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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

// auth route
Route::prefix('auth')->group(function () {
    Route::group(['controller' => ViewAuthController::class], function () {
        Route::get('/login', 'login')->name('login');
        Route::get('/register', 'register')->name('register');
        Route::get('/verify', 'verify');
    });
    Route::group(['controller' => BackendAuthController::class], function () {
        Route::post('/register', 'register')->name('be.register');
        Route::post('/login', 'login')->name('be.login');
        Route::post('/logout', 'logout')->name('be.logout')->middleware('auth');
        Route::post('/resend-verification', 'resend')->name('be.resend');
    });
});

// Umum route
Route::get('/', [LandingController::class, 'landing'])->name('client.home');
Route::get('/articles', [ClientArticleController::class, 'index'])->name('article');
Route::get('/about', [ClientAboutUsController::class, 'index'])->name('aboutUs');

// superadmin route
Route::group(['prefix' => 'superadmins', 'middleware' => ['can:superadmin']], function() {
    Route::get('/', [SuperadminDashboardController::class, 'index'])->name('superadmin.home');
    Route::get('/admins', [SuperadminKelolaAdminController::class, 'index'])->name('superadmin.kelola.admin');
    Route::get('/mitras', [SuperadminKelolaMitraController::class, 'index'])->name('superadmin.kelola.mitra');
    Route::get('/clients', [SuperadminKelolaClientController::class, 'index'])->name('superadmin.kelola.client');
    Route::post('/admins', [AdminController::class, 'makeAdmin'])->name('superadmin.make.admin');
});

// admin route
Route::group(['prefix' => 'admins', 'middleware' => ['can:admin']], function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.home');
    Route::get('/categories', [AdminKelolaKategoriController::class, 'index'])->name('admin.kelola.kategori');
    Route::group(['prefix' => 'categories', 'controller' => AdminCategoryController::class], function () {
        Route::post('/{id?}', 'storeCategory')->name('be.category.store');
        Route::get('/{id}', 'deleteCategory')->name('be.category.delete');
    });
});

// mitra route
Route::group(['prefix' => 'mitras', 'middleware' => ['can:mitra']], function () {
    Route::get('/', [MitraDashboardController::class, 'index'])->name('mitra.home');
    Route::get('/products/{id}/data', [MitraProductController::class, 'dataById'])->name('mitra.produk.data');
    Route::get('/products', [MitraKelolaProdukController::class, 'index'])->name('mitra.kelola.produk');
    Route::get('/products/{id}', [MitraProductController::class, 'deleteProduct'])->name('mitra.delete.produk');
    Route::get('/vendors', [MitraCreateVendorController::class, 'index'])->name('mitra.tambah.vendor.show');
    Route::post('/products/{id?}', [MitraProductController::class, 'storeProduct'])->name('mitra.store.produk');
    Route::post('/vendors', [MitraCreateVendorController::class, 'storeVendor'])->name('mitra.store.vendor');
});

// client route
Route::group(['middleware' => 'auth'], function () {
    Route::post('/plannings', [ClientPlanningController::class,'storePlanning'])->name('client.store.planning');
    Route::get('/products/{id}/detail', [ClientDetailProductController::class, 'index'])->name('client.detail.product');
    Route::get('/profile', [ClientProfileController::class,'profile'])->name('profile');
    Route::get('/plannings', [ClientPlanningShowController::class,'index'])->name('planning');
    Route::get('/plannings/detail/{id}', [ClientPlanningShowController::class,'detail'])->name('planning.detail');
    Route::get('/plannings/tambah', [ClientPlanningShowController::class,'store'])->name('planning.store');
    Route::get('/plannings/category', [ClientPlanningShowController::class,'category'])->name('planning.category');
    Route::get('/vendors/{categoryId}', [ClientVendorsController::class, 'index'])->name('vendors');
});

// Route::get('/mail', function () {
//     Mail::raw('ini test mail dari sipapii@smkn2smi.sch.id', function ($message) {
//         $message->to('hilal.muhammad0807@gmail.com')->subject('Test Mail');
//     });
// });