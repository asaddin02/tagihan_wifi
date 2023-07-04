<?php

use App\Http\Controllers\InstallationController;
use App\Http\Controllers\PackageController;
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
    Route::get('/', function () {
        return view('homepage');
    });

    // Route User
    Route::resource('user', UserController::class);

    // Route Installation
    Route::get('installation', [InstallationController::class, 'getInstallation']);
    Route::post('installation', [InstallationController::class, 'createInstallation'])->name('create.pemasangan');
    Route::post('installation/{$id}', [InstallationController::class, 'updateInstallation'])->name('edit.pemasangan');
});

Route::middleware(['auth', 'admin'])->group(function () {
    // Route Package
    Route::resource('package', PackageController::class);

    // Route Technisian
    Route::get('technic', [TechnisianController::class, 'index']);
    Route::post('technic', [TechnisianController::class, 'create'])->name('create.teknisi');
    Route::post('technic/{id}', [TechnisianController::class, 'edit'])->name('edit.teknisi');
    Route::get('technic/{id}', [TechnisianController::class, 'delete'])->name('delete.teknisi');
});
