<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceManagementController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\PayPalController;

// Default redirect
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('show.dashboard')
        : redirect()->route('show.login');
});

// =====================
// Public Routes
// =====================
Route::get('/showLogin', [CustomAuthController::class, 'showLogin'])->name('show.login');
Route::post('/loginUser', [CustomAuthController::class, 'loginUser'])->name('login.user');
Route::get('/editProfile/{id}', [CustomAuthController::class, 'editProfile'])->name('editProfile');
Route::put('user/update/{id}', [CustomAuthController::class, 'userUpdate'])->name('user.update');

// =====================
// Protected Routes
// =====================

// Route::middleware(['check.role'])->group(function () {
    Route::get('/user/logout', [CustomAuthController::class, 'customLogout'])->name('user.logout');
    Route::prefix('show/dashboard')->controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('show.dashboard');
    });
    Route::prefix('invoice')->controller(InvoiceManagementController::class)->group(function () {
        Route::get('/filter', 'filter')->name('invoice.filter');
        Route::post('/index', 'index')->name('invoice.list');
        Route::get('/create', 'createInvoice')->name('invoice.create');
        Route::post('/store', 'storeInvoice')->name('invoice.store');
        Route::post('/exportInvoice', 'exportInvoice')->name('exportInvoice');
        Route::get('/delete/{id}', 'delete')->name('invoice.delete');
        Route::get('/edit/{id}', 'edit')->name('invoice.edit');
        Route::put('/update/{id}', 'update')->name('invoice.update');
    });
    Route::prefix('brand')->controller(BrandController::class)->group(function () {
        Route::get('/index', 'index')->name('brand.list');
        Route::get('/create', 'create')->name('brand.create');
        Route::post('/store', 'store')->name('brand.store');
        Route::get('/delete/{id}', 'delete')->name('brand.delete');
        Route::get('/edit/{id}', 'edit')->name('brand.edit');
        Route::put('/update/{id}', 'update')->name('brand.update');
    });

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
// });


Route::domain('bookpublishersden.com')->group(function () {
    Route::get('/paypal/pay/{id}', [PaypalController::class,'show'])->name('paypal.show');
});

//Route::get('/paypal/pay/{id}', [PaypalController::class,'show'])->name('paypal.show');
// Route::get('/paypal/pay/dummy/{brand_name}/{id}', [PaypalController::class,'checkoutDummy'])->name('dummy.paypal.show');
Route::post('/paypal/create', [PaypalController::class,'createPayment'])->name('paypal.create');
Route::get('/paypal/success/{invoice_id}', [PaypalController::class,'success'])->name('paypal.success');
Route::get('/paypal/cancel/{invoice_id}', [PaypalController::class,'cancel'])->name('paypal.cancel');
Route::post('/api/paypal/create-order', [PaypalController::class, 'createPayment']);
Route::post('/api/paypal/capture-order', [PaypalController::class, 'success']);
Route::get('/paypal/card', function () {
    return view('paypal.card-checkout');
});


Route::post('/create-paypal-order', [PaypalController::class, 'createOrder']);
Route::post('/capture-paypal-order', [PaypalController::class, 'captureOrder']);


