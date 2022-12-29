<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\PermissionController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\RoleController;
use App\Http\Controllers\Web\SettingController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-process', [AuthController::class, 'login_process'])->name('login.process');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register-process', [AuthController::class, 'register_process'])->name('register.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', [SettingController::class, 'index'])->middleware('auth')->name('home');
Route::get('/toggle-theme', [SettingController::class, 'toggle_theme']);

Route::prefix('/profile')->name('profile.')->middleware('auth')->group(function () {
    Route::get('/personal-info', [ProfileController::class, 'personal_info'])->name('personal_info');
    Route::put('/{user}/personal-info-update', [ProfileController::class, 'personal_info_update'])->name('personal_info_update');
    Route::get('/reset-password', [ProfileController::class, 'reset_password'])->name('reset_password');
    Route::put('/{user}/reset-password-update', [ProfileController::class, 'reset_password_update'])->name('reset_password_update');
});

Route::prefix('/user-management')->name('user_management.')->middleware('auth')->group(function () {
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/{user}/detail', [UserController::class, 'show'])->name('detail');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}/update', [UserController::class, 'update'])->name('update');
        Route::get('/{user}/assign', [UserController::class, 'assign'])->name('assign');
        Route::put('/{user}/assign_role', [UserController::class, 'assign_role'])->name('assign_role');
        Route::put('/{user}/assign_permission', [UserController::class, 'assign_permission'])->name('assign_permission');
        Route::delete('/{user}/delete', [UserController::class, 'delete'])->name('delete');
    });
    Route::prefix('role')->name('role.')->middleware('auth')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/store', [RoleController::class, 'store'])->name('store');
        Route::get('/{role}/detail', [RoleController::class, 'show'])->name('detail');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit');
        Route::put('/{role}/update', [RoleController::class, 'update'])->name('update');
        Route::delete('/{role}/delete', [RoleController::class, 'delete'])->name('delete');
    });
    Route::prefix('permission')->name('permission.')->middleware('auth')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('index');
        Route::get('/create', [PermissionController::class, 'create'])->name('create');
        Route::post('/store', [PermissionController::class, 'store'])->name('store');
        Route::get('/{permission}/detail', [PermissionController::class, 'show'])->name('detail');
        Route::get('/{permission}/edit', [PermissionController::class, 'edit'])->name('edit');
        Route::put('/{permission}/update', [PermissionController::class, 'update'])->name('update');
        Route::delete('/{permission}/delete', [PermissionController::class, 'delete'])->name('delete');
    });
});
