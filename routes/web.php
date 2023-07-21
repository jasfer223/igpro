<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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

// INDEX
Route::get('/', [IndexController::class, 'redirectToLogin'])->name('index');

// LOGIN
Route::get('/login', [UserController::class, 'showLogin'])->name('login');

// ADMIN
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'showAdminDashboard'])->name('admin.dashboard');
});

// USER
Route::prefix('user')->group(function () {
    Route::name('user.')->group(function () {
        Route::get('/dashboard', [UserController::class, 'showDashboard'])->name('dashboard');
    });
});