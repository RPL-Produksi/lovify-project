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
use App\Http\Controllers\Views\AuthController;
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
use App\Http\Controllers\Views\PersonalShowController;
use App\Http\Controllers\Views\Superadmin\SuperadminDashboardController;
use App\Http\Controllers\Views\Superadmin\SuperadminKelolaAdminController;
use App\Http\Controllers\Views\Superadmin\SuperadminKelolaClientController;
use App\Http\Controllers\Views\Superadmin\SuperadminKelolaMitraController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

// public route
Route::get('/', [LandingController::class, 'landing'])->name('client.home');
Route::get('/articles', [ClientArticleController::class, 'index'])->name('article');
Route::get('/about', [ClientAboutUsController::class, 'index'])->name('aboutUs');

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

// superadmin route
Route::group(['prefix' => 'superadmins', 'middleware' => ['can:superadmin']], function () {
    Route::get('/', [SuperadminDashboardController::class, 'index'])->name('superadmin.home');
    Route::prefix('admins')->group(function () {
        Route::group(['controller' => SuperadminKelolaAdminController::class], function () {
            Route::get('/', 'index')->name('superadmin.kelola.admin');
            Route::get('/data', 'getData')->name('superadmin.kelola.admin.data');
        });
        Route::group(['controller' => AdminController::class], function () {
            Route::post('/store',  'makeAdmin')->name('superadmin.make.admin');
            Route::post('/update/{id}',  'updateAdmin')->name('superadmin.update.admin');
            Route::delete('/delete/{id}',  'deleteAdmin')->name('superadmin.delete.admin');
        });
    });

    Route::prefix('mitra')->group(function () {
        Route::group(['controller' => SuperadminKelolaMitraController::class], function () {
            Route::get('/',  'index')->name('superadmin.kelola.mitra');
            Route::get('/data',  'getData')->name('superadmin.kelola.mitra.data');
        });
        Route::post('/store', [MitraController::class, 'makeMitra'])->name('superadmin.store.mitra');
    });

    Route::prefix('client')->group(function () {
        Route::group(['controller' => SuperadminKelolaClientController::class], function () {
            Route::get('/', 'index')->name('superadmin.kelola.client');
            Route::get('/data', 'getData')->name('superadmin.kelola.client.data');
        });
        Route::post('/store', [ClientController::class, 'makeClient'])->name('superadmin.make.client');
    });
});

// admin route
Route::group(['prefix' => 'admins', 'middleware' => ['can:admin']], function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.home');
    Route::group(['controller' => AdminKelolaLokasiController::class, 'prefix' => 'lokasi'], function () {
        Route::get('/', 'index')->name('admin.kelola.lokasi');
        Route::get('/data', 'getData')->name('admin.kelola.lokasi.data');
    });
    Route::group(['controller' => AdminKelolaKategoriController::class, 'prefix' => 'categories'], function () {
        Route::get('/', 'index')->name('admin.kelola.kategori');
        Route::get('/data', 'getData')->name('admin.kelola.kategori.data');
    });
    Route::group(['controller' => AdminLocationController::class, 'prefix' => 'lokasi'], function () {
        Route::post('/store', 'storeLocation')->name('admin.lokasi.store');
        Route::post('/update/{id}', 'storeLocation')->name('admin.lokasi.update');
        Route::delete('/delete/{id}', 'deleteLocation')->name('admin.lokasi.delete');
    });
    Route::group(['prefix' => 'categories', 'controller' => AdminCategoryController::class], function () {
        Route::post('/', 'storeCategory')->name('be.category.store');
        Route::post('/{id}', 'storeCategory')->name('be.category.update');
        Route::delete('/{id}', 'deleteCategory')->name('be.category.delete');
    });
});

// mitra route
Route::group(['prefix' => 'mitras', 'middleware' => ['can:mitra']], function () {
    Route::prefix('products')->group(function () {
        Route::get('/get', [ProductController::class, 'getProducts'])->name('mitra.get.products');
        Route::get('/{id}/data', [MitraProductController::class, 'dataById'])->name('mitra.produk.data');
        Route::get('/', [MitraKelolaProdukController::class, 'index'])->name('mitra.kelola.produk');
        Route::post('/{id?}', [MitraProductController::class, 'storeProduct'])->name('mitra.store.produk');
        Route::delete('/{id}', [MitraProductController::class, 'deleteProduct'])->name('mitra.delete.produk');
        Route::get('/data', [MitraKelolaProdukController::class, 'getData'])->name('mitra.kelola.produk.data');
    });
    Route::prefix('vendors')->group(function () {
        Route::get('/', [MitraCreateVendorController::class, 'index'])->name('mitra.tambah.vendor.show');
        Route::post('/store', [MitraVendorController::class, 'storeVendor'])->name('mitra.store.vendor');
    });
    Route::get('/', [MitraDashboardController::class, 'index'])->name('mitra.home');
});

// auth and client route
Route::group(['middleware' => 'auth'], function () {
    Route::group(['controller' => ClientPlanningController::class, 'prefix' => 'planning'], function () {
        Route::post('store', 'storePlanningSecond')->name('client.store.planning');
        Route::post('update', 'storePlanning')->name('client.update.planning');
        Route::post('update/{id}', 'storePlanning')->name('client.update.planning');
        Route::delete('/delete/{id}', 'deletePlanning')->name('client.delete.planning');
    });
    Route::group(['controller' => PersonalController::class, 'prefix' => 'profile'], function () {
        Route::post('/change', 'changeProfile')->name('profile.change');
        Route::delete('/avatar', 'deleteAvatar')->name('profile.deleteAvatar');
        Route::post('/update/password', 'changePassword')->name('client.update.password');
    });
    Route::group(['controller' => ClientPlanningShowController::class, 'prefix' => 'planning'], function () {
        Route::get('/', 'index')->name('planning');
        Route::get('/detail/{id}', 'detail')->name('planning.detail');
        Route::get('/store/{id?}', 'store')->name('planning.store');
        Route::get('/category',  'category')->name('planning.category');
    });
    Route::group(['controller' => ClientOrderShowController::class, 'prefix' => 'order'], function () {
        Route::get('/history', 'history')->name('client.history');
        Route::get('/{planning}', 'index')->name('client.order');
        Route::get('/detail/{id}', 'detail')->name('client.order.detail');
    });
    Route::group(['controller' => PersonalShowController::class, 'prefix' => 'user'], function () {
        Route::get('/profile', 'profile')->name('user.profile');
        Route::get('/change/password', 'changePassword')->name('user.change.password');
        Route::get('/change/password/{id}', 'changePasswordUser')->name('user.change.password.choose');
    });
    Route::get('/detail/product/{id}', [ClientDetailProductController::class, 'index'])->name('client.detail.product');
    Route::get('/profile', [ClientProfileController::class, 'profile'])->name('profile');
    Route::get('/vendors/{categoryId}', [ClientVendorsController::class, 'index'])->name('vendors');
    Route::get('/change/password', [AuthController::class, 'changePassword'])->name('client.change.password');
    Route::post('/order/store/{id}', [ClientOrderController::class, 'storeOrder'])->name('client.order.store');
    Route::get('/progres/{order}', [ClientOrderProgresController::class, 'orderProgres'])->name('client.order.progres');
    Route::post('/transactions/{id}/pay', [ClientTransactionController::class, 'storePayment']);
});

// Route::get('/mail', function () {
//     Mail::raw('ini test mail dari sipapii@smkn2smi.sch.id', function ($message) {
//         $message->to('hilal.muhammad0807@gmail.com')->subject('Test Mail');
//     });
// });
