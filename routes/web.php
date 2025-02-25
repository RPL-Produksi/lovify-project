<?php

use App\Http\Controllers\BackEnd\v1\AuthController as BackendAuthController;
use App\Http\Controllers\BackEnd\v1\Admins\AdminCategoryController;
use App\Http\Controllers\BackEnd\v1\Admins\AdminLocationController;
use App\Http\Controllers\BackEnd\v1\Clients\ClientOrderController;
use App\Http\Controllers\BackEnd\v1\Clients\ClientPlanningController;
use App\Http\Controllers\BackEnd\v1\Clients\ClientTransactionController;
use App\Http\Controllers\BackEnd\v1\Mitras\MitraProductController;
use App\Http\Controllers\BackEnd\v1\Mitras\MitraVendorController;
use App\Http\Controllers\BackEnd\v1\PersonalController;
use App\Http\Controllers\BackEnd\v1\ProductController;
use App\Http\Controllers\BackEnd\v1\Superadmins\AdminController;
use App\Http\Controllers\BackEnd\v1\Superadmins\ClientController;
use App\Http\Controllers\BackEnd\v1\Superadmins\MitraController;
use App\Http\Controllers\Views\Admin\AdminDashboardController;
use App\Http\Controllers\Views\Admin\AdminKelolaKategoriController;
use App\Http\Controllers\Views\Admin\AdminKelolaLokasiController;
use App\Http\Controllers\Views\Clients\ClientAboutUsController;
use App\Http\Controllers\Views\Clients\ClientArticleController;
use App\Http\Controllers\Views\Clients\ClientDetailProductController;
use App\Http\Controllers\Views\AuthController as ViewAuthController;
use App\Http\Controllers\Views\Clients\ClientOrderProgresController;
use App\Http\Controllers\Views\Clients\ClientOrderShowController;
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
use Illuminate\Support\Facades\Auth;
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
Route::group(['prefix' => 'superadmins', 'middleware' => ['can:superadmin']], function () {
    Route::get('/', [SuperadminDashboardController::class, 'index'])->name('superadmin.home');

    Route::get('/admins', [SuperadminKelolaAdminController::class, 'index'])->name('superadmin.kelola.admin');
    Route::get('/admins/data', [SuperadminKelolaAdminController::class, 'getData'])->name('superadmin.kelola.admin.data');
    Route::post('/admins/store', [AdminController::class, 'makeAdmin'])->name('superadmin.make.admin');
    Route::post('/admins/update/{id}', [AdminController::class, 'updateAdmin'])->name('superadmin.update.admin');
    Route::delete('/admins/delete/{id}', [AdminController::class, 'deleteAdmin'])->name('superadmin.delete.admin');

    Route::get('/mitra', [SuperadminKelolaMitraController::class, 'index'])->name('superadmin.kelola.mitra');
    Route::get('/mitra/data', [SuperadminKelolaMitraController::class, 'getData'])->name('superadmin.kelola.mitra.data');
    Route::post('/mitra/store', [MitraController::class, 'makeMitra'])->name('superadmin.store.mitra');

    Route::get('/client', [SuperadminKelolaClientController::class, 'index'])->name('superadmin.kelola.client');
    Route::get('/client/data', [SuperadminKelolaClientController::class, 'getData'])->name('superadmin.kelola.client.data');
    Route::post('/client/store', [ClientController::class, 'makeClient'])->name('superadmin.make.client');
});

// admin route
Route::group(['prefix' => 'admins', 'middleware' => ['can:admin']], function () {
    Route::get('/lokasi', [AdminKelolaLokasiController::class, 'index'])->name('admin.kelola.lokasi');
    Route::get('/lokasi/data', [AdminKelolaLokasiController::class, 'getData'])->name('admin.kelola.lokasi.data');

    Route::post('/lokasi/store', [AdminLocationController::class, 'storeLocation'])->name('admin.lokasi.store');
    Route::post('/lokasi/update/{id}', [AdminLocationController::class, 'storeLocation'])->name('admin.lokasi.update');
    Route::delete('/lokasi/delete/{id}', [AdminLocationController::class, 'deleteLocation'])->name('admin.lokasi.delete');

    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.home');
    Route::get('/categories', [AdminKelolaKategoriController::class, 'index'])->name('admin.kelola.kategori');
    Route::get('/categories/data', [AdminKelolaKategoriController::class, 'getData'])->name('admin.kelola.kategori.data');
    Route::group(['prefix' => 'categories', 'controller' => AdminCategoryController::class], function () {
        Route::post('/', 'storeCategory')->name('be.category.store');
        Route::post('/{id}', 'storeCategory')->name('be.category.update');
        Route::delete('/{id}', 'deleteCategory')->name('be.category.delete');
    });
});

// mitra route
Route::group(['prefix' => 'mitras', 'middleware' => ['can:mitra']], function () {
    Route::get('/', [MitraDashboardController::class, 'index'])->name('mitra.home');
    Route::get('/get/products', [ProductController::class, 'getProducts'])->name('mitra.get.products');
    Route::get('/products/{id}/data', [MitraProductController::class, 'dataById'])->name('mitra.produk.data');
    Route::get('/products', [MitraKelolaProdukController::class, 'index'])->name('mitra.kelola.produk');
    Route::get('/vendors', [MitraCreateVendorController::class, 'index'])->name('mitra.tambah.vendor.show');
    Route::post('/products/{id?}', [MitraProductController::class, 'storeProduct'])->name('mitra.store.produk');
    Route::post('/vendors', [MitraVendorController::class, 'storeVendor'])->name('mitra.store.vendor');

    Route::delete('/products/{id}', [MitraProductController::class, 'deleteProduct'])->name('mitra.delete.produk');
    Route::get('/data', [MitraKelolaProdukController::class, 'getData'])->name('mitra.kelola.produk.data');
});

// client route
Route::group(['middleware' => 'auth'], function () {
    Route::post('store/planning', [ClientPlanningController::class, 'storePlanningSecond'])->name('client.store.planning');
    Route::post('update/planning', [ClientPlanningController::class, 'storePlanning'])->name('client.update.planning');
    Route::post('update/planning/{id}', [ClientPlanningController::class, 'storePlanning'])->name('client.update.planning');
    Route::get('/detail/product/{id}', [ClientDetailProductController::class, 'index'])->name('client.detail.product');
    Route::post('/profile/change', [PersonalController::class, 'changeProfile'])->name('profile.change');
    Route::get('/profile', [ClientProfileController::class, 'profile'])->name('profile');
    Route::delete('/profile/avatar', [PersonalController::class, 'deleteAvatar'])->name('profile.deleteAvatar');
    Route::get('/planning', [ClientPlanningShowController::class, 'index'])->name('planning');
    Route::get('/planning/detail/{id}', [ClientPlanningShowController::class, 'detail'])->name('planning.detail');
    Route::get('/planning/store/{id?}', [ClientPlanningShowController::class, 'store'])->name('planning.store');
    Route::get('/planning/category', [ClientPlanningShowController::class, 'category'])->name('planning.category');

    Route::get('/vendors/{categoryId}', [ClientVendorsController::class, 'index'])->name('vendors');
    Route::delete('/planning/delete/{id}', [ClientPlanningController::class, 'deletePlanning'])->name('client.delete.planning');

    Route::get('/order/{planning}', [ClientOrderShowController::class, 'index'])->name('client.order');
    Route::get('/order/detail/{id}', [ClientOrderShowController::class, 'detail'])->name('client.order.detail');
    Route::post('/order/store/{id}', [ClientOrderController::class, 'storeOrder'])->name('client.order.store');
    Route::get('/progres/{order}', [ClientOrderProgresController::class, 'orderProgres'])->name('client.order.progres');

    Route::post('/transactions/{id}/pay', [ClientTransactionController::class, 'storePayment']);
});

// Route::get('/mail', function () {
//     Mail::raw('ini test mail dari sipapii@smkn2smi.sch.id', function ($message) {
//         $message->to('hilal.muhammad0807@gmail.com')->subject('Test Mail');
//     });
// });
