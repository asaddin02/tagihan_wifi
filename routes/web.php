<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\InstallationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\SpendingController;
use App\Http\Controllers\TechnisianController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route User Authentiaction
Route::get('login', function () {
    return view('authentication.login');
})->name('login');
Route::post('login', [UserController::class, 'login'])->name('user.login');

Route::middleware(['auth'])->group(function () {
    // Route view Dashboard
    Route::get('/', [HomeController::class, 'index']);

    // Route User
    Route::resource('user', UserController::class);
    Route::get('logout', [UserController::class, 'logout']);

    // Route Installation
    Route::get('installation', [InstallationController::class, 'getInstallation']);
    Route::post('installation/create', [InstallationController::class, 'createInstallation'])->name('create.pemasangan');
    Route::post('installation/status/{id}', [InstallationController::class, 'updateInstallation'])->name('edit.pemasangan');
    Route::post('installation/address/{id}', [InstallationController::class, 'updateInstallationAddress'])->name('edit.alamat');
});

Route::middleware(['auth', 'admin'])->group(function () {
    // Route Package
    Route::resource('package', PackageController::class);

    // Route Package
    Route::resource('customer', CustomerController::class);
    Route::get('customer/invoice/{id}', [CustomerController::class, 'invoice']);
    Route::get('customer/detail/{id}', [CustomerController::class, 'detail']);
    Route::post('customer/whatsapp', [CustomerController::class, 'whatsapp'])->name('whatsapp.customer');
    Route::post('customer/search', [CustomerController::class, 'search'])->name('customer.search');

    // Route Technisian
    Route::get('technic', [TechnisianController::class, 'index']);
    Route::post('technic/create', [TechnisianController::class, 'create'])->name('create.teknisi');
    Route::post('technic/whatsapp', [TechnisianController::class, 'whatsapp'])->name('whatsapp.teknisi');
    Route::post('technic/{id}', [TechnisianController::class, 'edit'])->name('edit.teknisi');
    Route::get('technic/{id}', [TechnisianController::class, 'delete'])->name('delete.teknisi');

    // Route Invoice
    Route::resource('invoice', InvoiceController::class);

    // Route Income
    Route::resource('income', IncomeController::class);
    Route::post('income/filter', [IncomeController::class, 'filter'])->name('income.filter');

    // Route Spending
    Route::resource('spending', SpendingController::class);
    Route::post('spending/filter', [SpendingController::class, 'filter'])->name('spending.filter');
});
