<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');
Route::get('/events', [HomeController::class, 'events'])
    ->name('events');



//// Admin Routes
//Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
//Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
//Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
//
//// Admin Dashboard - Protected by middleware
//Route::middleware('admin.auth')->group(function () {
//    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
//
//    // Events
//    Route::post('/admin/events/store', [AdminDashboardController::class, 'storeEvent'])->name('admin.events.store');
//    Route::put('/admin/events/{id}', [AdminDashboardController::class, 'updateEvent'])->name('admin.events.update');
//    Route::delete('/admin/events/{id}', [AdminDashboardController::class, 'destroyEvent'])->name('admin.events.destroy');
//
//    // Tips
//    Route::post('/admin/tips/store', [AdminDashboardController::class, 'storeTip'])->name('admin.tips.store');
//    Route::put('/admin/tips/{id}', [AdminDashboardController::class, 'updateTip'])->name('admin.tips.update');
//    Route::delete('/admin/tips/{id}', [AdminDashboardController::class, 'destroyTip'])->name('admin.tips.destroy');
//
//    // Map Markers
//    Route::post('/admin/markers/store', [AdminDashboardController::class, 'storeMarker'])->name('admin.markers.store');
//    Route::put('/admin/markers/{id}', [AdminDashboardController::class, 'updateMarker'])->name('admin.markers.update');
//    Route::delete('/admin/markers/{id}', [AdminDashboardController::class, 'destroyMarker'])->name('admin.markers.destroy');
//});
//


//// API Routes for fetching data (public access)
Route::get('/api/events', [HomeController::class, 'getEvents']);
Route::get('/api/tips', [HomeController::class, 'getTips']);
Route::get('/api/markers', [HomeController::class, 'getMarkers']);
