<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerserviceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\InstallationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MikrotikController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\SpendingController;
use App\Http\Controllers\TechnisianController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
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
    if (Auth::user()) {
        return back();
    } else {
        return view('authentication.login');
    }
})->name('login');

Route::post('login', [UserController::class, 'login'])->name('user.login');

Route::middleware(['auth'])->group(function () {
    // Route User
    Route::resource('user', UserController::class);
    Route::get('logout', [UserController::class, 'logout']);

    // Route view Dashboard
    Route::get('/', [HomeController::class, 'index']);

    // Route Income
    Route::resource('income', IncomeController::class)->middleware('admin');

    // Route Spending
    Route::resource('spending', SpendingController::class)->middleware('admin');

    // Route Technisian
    Route::get('technic', [TechnisianController::class, 'index']);
    Route::post('technic/whatsapp', [TechnisianController::class, 'whatsapp'])->name('whatsapp.teknisi')->middleware('admincs');
    Route::middleware(['admin'])->group(function () {
        Route::post('technic/create', [TechnisianController::class, 'create'])->name('create.teknisi');
        Route::post('technic/{id}', [TechnisianController::class, 'edit'])->name('edit.teknisi');
        Route::get('technic/{id}', [TechnisianController::class, 'delete'])->name('delete.teknisi');
    });

    // Route Customer Service
    Route::middleware(['admin'])->group(function () {
        Route::resource('cs', CustomerserviceController::class);
        Route::post('cs/whatsapp', [CustomerserviceController::class, 'whatsapp'])->name('whatsapp.cs');
    });

    // Route Package
    Route::resource('package', PackageController::class)->middleware('admin');

    // Route Installation
    Route::get('installation', [InstallationController::class, 'getInstallation'])->middleware('admincs');
    Route::middleware(['cs'])->group(function () {
        Route::post('installation/create', [InstallationController::class, 'createInstallation'])->name('create.pemasangan');
        Route::post('installation/status/{id}', [InstallationController::class, 'updateInstallation'])->name('edit.pemasangan');
        Route::post('installation/address/{id}', [InstallationController::class, 'updateInstallationAddress'])->name('edit.alamat');
        Route::post('installation/delete/{id}', [InstallationController::class, 'deleteInstallation'])->name('hapus.pemasangan');
    });

    // Route Customer
    Route::middleware(['admincs'])->group(function () {
        Route::resource('customer', CustomerController::class);
        Route::get('customer/invoice/{id}', [CustomerController::class, 'invoice']);
        Route::get('customer/detail/{id}', [CustomerController::class, 'detail']);
    });
    Route::middleware(['cs'])->group(function () {
        Route::post('customer/whatsapp', [CustomerController::class, 'whatsapp'])->name('whatsapp.customer');
        Route::post('customer/delete/{id}', [CustomerController::class, 'deleteCustomer'])->name('hapus.customer');
    });

    // Route Invoice
    Route::resource('invoice', InvoiceController::class)->middleware('cs');
});

Route::get('mikrotik',[MikrotikController::class,'index']);
