<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminLogoutController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])
    ->middleware('guest')
    ->name('home');
Route::get('/events', [HomeController::class, 'events'])
    ->middleware('guest')
    ->name('events');


Route::get('/admin', [AdminLoginController::class, 'index'])
    ->name('admin.login');
Route::post('/admin', [AdminLoginController::class, 'login'])
    ->name('admin.login');

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
    Route::post('/admin/logout', [AdminLogoutController::class])
        ->name('admin.logout');
});
