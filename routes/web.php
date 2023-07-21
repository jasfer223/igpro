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

// INDEX ROUTES
Route::get('/', [IndexController::class, 'redirectToLogin'])->name('index');
Route::get('/login', [UserController::class, 'showLogin'])->name('login');


// ADMIN ROUTES
Route::prefix('admin')->group(function () {
    // Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'showAdminDashboard'])->name('admin.dashboard');
        Route::post('/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');

    // });
});

// USER ROUTES
Route::get('/dashboard', [UserController::class, 'showDashboard'])->name('user.dashboard');


