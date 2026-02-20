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
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BillManagementController;
use App\Http\Controllers\ExpensesManagementController;
use App\Http\Controllers\CustomerPaymentController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\LedgerController;

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
Route::prefix('customer')->controller(CustomerController::class)->group(function () {
    Route::get('/index', 'index')->name('customer.list');
    Route::get('/create', 'create')->name('customer.create');
    Route::post('/store', 'store')->name('customer.store');
    Route::get('/delete/{id}', 'delete')->name('customer.delete');
    Route::get('/laser/{id}', 'filter')->name('customer.laser');
    Route::get('/edit/{id}', 'edit')->name('customer.edit');
    Route::put('/update/{id}', 'update')->name('customer.update');
});
Route::prefix('bill')->controller(BillManagementController::class)->group(function () {
    Route::get('/index', 'index')->name('bill.list');
    Route::get('/filter', 'filter')->name('bill.filter');
    Route::post('/list', 'list')->name('bill.index');
    Route::get('/create', 'create')->name('bill.create');
    Route::post('/store', 'store')->name('bill.store');
    Route::get('/delete/{id}', 'delete')->name('bill.delete');
    Route::get('/laser/{id}', 'filter')->name('bill.laser');
    Route::get('/edit/{id}', 'edit')->name('bill.edit');
    Route::put('/update/{id}', 'update')->name('bill.update');
});
Route::prefix('expenses')->controller(ExpensesManagementController::class)->group(function () {
    Route::get('/index', 'index')->name('expenses.list');
    Route::get('/filter', 'filter')->name('expenses.filter');
    Route::post('/list', 'list')->name('expenses.index');
    Route::get('/create', 'create')->name('expenses.create');
    Route::post('/store', 'store')->name('expenses.store');
    Route::get('/delete/{id}', 'delete')->name('expenses.delete');
    Route::get('/laser/{id}', 'filter')->name('expenses.laser');
    Route::get('/edit/{id}', 'edit')->name('expenses.edit');
    Route::put('/update/{id}', 'update')->name('expenses.update');
});
Route::prefix('bank')->controller(BankController::class)->group(function () {
    Route::get('/index', 'index')->name('bank.list');
    Route::get('/create', 'create')->name('bank.create');
    Route::post('/store', 'store')->name('bank.store');
    Route::delete('/delete/{bank}', 'delete')->name('bank.delete');
    Route::get('/edit/{bank}', 'edit')->name('bank.edit');
    Route::put('/update/{bank}', 'update')->name('bank.update');
});



Route::prefix('payment')->controller(CustomerPaymentController::class)->group(function () {
    Route::post('/list', 'list')->name('payment.list');
    Route::get('/create', 'create')->name('payment.create');
    Route::post('/store', 'store')->name('payment.store');
    Route::get('/filter', 'filter')->name('payment.filter');
    Route::get('/delete/{id}', 'delete')->name('payment.delete');
    Route::get('/edit/{payment}', 'edit')->name('payment.edit');
    Route::put('/update/{id}', 'update')->name('payment.update');
});
Route::prefix('ledger')->controller(LedgerController::class)->group(function () {
    Route::get('/filter/{id}', 'filter')->name('ledger.filter');
    Route::post('/list', 'list')->name('ledger.list');
});




Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::resource('products', ProductController::class);
// });


Route::domain('bookpublishersden.com')->group(function () {
    Route::get('/paypal/pay/{id}', [PaypalController::class, 'show'])->name('paypal.show');
});

//Route::get('/paypal/pay/{id}', [PaypalController::class,'show'])->name('paypal.show');
// Route::get('/paypal/pay/dummy/{brand_name}/{id}', [PaypalController::class,'checkoutDummy'])->name('dummy.paypal.show');
Route::post('/paypal/create', [PaypalController::class, 'createPayment'])->name('paypal.create');
Route::get('/paypal/success/{invoice_id}', [PaypalController::class, 'success'])->name('paypal.success');
Route::get('/paypal/cancel/{invoice_id}', [PaypalController::class, 'cancel'])->name('paypal.cancel');
Route::post('/api/paypal/create-order', [PaypalController::class, 'createPayment']);
Route::post('/api/paypal/capture-order', [PaypalController::class, 'success']);
Route::get('/paypal/card', function () {
    return view('paypal.card-checkout');
});


Route::post('/create-paypal-order', [PaypalController::class, 'createOrder']);
Route::post('/capture-paypal-order', [PaypalController::class, 'captureOrder']);
