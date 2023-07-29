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

Route::middleware('is-auth')->group(function () {

    // LOGIN
    Route::get('/', [UserController::class, 'showLogin']);
    Route::get('/login', [UserController::class, 'showLogin'])->name('login');
    Route::post('/login/auth', [UserController::class, 'authenticate'])->name('auth');

});

Route::middleware('auth')->group(function () {
    
    // USER 
    // User Logout
    Route::post('/logout', [UserController::class, 'userLogout'])->name('user-logout');

    // User Dashboard
    Route::get('/dashboard', [UserController::class, 'showDashboard'])->name('user.dashboard');

    // User Manage Projects
    Route::get('/manage/projects', [UserController::class, 'showProjects'])->name('user.projects');

});


Route::middleware('auth', 'admin')->prefix('admin')->group(function () {
    
    // ADMIN 
    // Admin Logout
    Route::post('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin-logout');

    // Admin Dashboard
    Route::get('/dashboard', [AdminController::class, 'showAdminDashboard'])->name('admin.dashboard');
    
    // Admin Manage Users
    Route::get('/manage/users', [AdminController::class, 'showUsers'])->name('admin.users');
    Route::post('/manage/users/create', [AdminController::class, 'createUser'])->name('create-user');
    
    // Admin Manage Campus
    Route::get('/manage/campuses', [AdminController::class, 'showCampus'])->name('admin.campuses');
    Route::post('/manage/campuses/create', [AdminController::class, 'createCampus'])->name('create-campus');
    
    // Admin Manage Roles
    Route::get('/manage/roles', [AdminController::class, 'showRoles'])->name('admin.roles');
    Route::post('/manage/roles/create', [AdminController::class, 'createRole'])->name('create-role');

    // Admin Manage Projects
    Route::get('/manage/projects', [AdminController::class, 'showProjects'])->name('admin.projects');
    Route::post('/manage/projects/create', [AdminController::class, 'createProject'])->name('create-project');
    
});

    