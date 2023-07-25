<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Models\User;

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

// Login Routes
Route::get('/', [UserController::class, 'showLogin']);
Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'authenticate'])->name('auth');
Route::post('/logout', [UserController::class, 'logout'])->name('logout'); // Logout (applies to both users and admins)

// Role-based middleware for other routes
Route::get('/dashboard', [UserController::class, 'showDashboard'])->name('user.dashboard');
Route::get('/manage/projects', [UserController::class, 'showProjects'])->name('user.projects');

// Admin-specific middleware for admin routes
Route::prefix('admin')->group(function () {
    // Your admin-specific routes go here
    Route::get('/dashboard', [AdminController::class, 'showAdminDashboard'])->name('admin.dashboard');
    Route::get('/manage/users', [AdminController::class, 'showUsers'])->name('admin.users');
    Route::get('/manage/campuses', [AdminController::class, 'showCampus'])->name('admin.campuses');
    Route::get('/manage/roles', [AdminController::class, 'showRoles'])->name('admin.roles');
    Route::post('/manage/users/create', [AdminController::class, 'createUser'])->name('create-user');
    Route::post('/manage/campuses/create', [AdminController::class, 'createCampus'])->name('create-campus');
    Route::post('/manage/roles/create', [AdminController::class, 'createRole'])->name('create-role');

});

    