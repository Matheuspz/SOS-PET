<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminLogoutController;
use App\Http\Controllers\DicasController;
use App\Http\Controllers\EventosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MarcadoresController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');
Route::get('/events', [HomeController::class, 'events'])
    ->name('events');


Route::get('/admin', [AdminLoginController::class, 'index'])
    ->name('admin.login');
Route::post('/admin', [AdminLoginController::class, 'login'])
    ->name('admin.login');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
    Route::post('/admin/logout', [AdminLogoutController::class])
        ->name('admin.logout');

    Route::controller(EventosController::class)->group(function () {

        Route::get('/admin/eventos', 'index');

        Route::post("/admin/eventos", "store")
            ->name("admin.eventos.store");
        Route::put("/admin/eventos/{eventos}", "update")
            ->name("admin.eventos.update");
        Route::delete("/admin/eventos/{eventos}", "destroy")
            ->name("admin.eventos.destroy");
    });
    Route::controller(DicasController::class)->group(function () {

        Route::get('/admin/dicas', 'index');

        Route::post("/admin/dicas", "store")
            ->name("admin.dicas.store");
        Route::put("/admin/dicas/{dicas}", "update")
            ->name("admin.dicas.update");
        Route::delete("/admin/dicas/{dicas}", "destroy")
            ->name("admin.dicas.destroy");
    });
    Route::controller(MarcadoresController::class)->group(function () {

        Route::get('/admin/marcadores', 'index');

        Route::post("/admin/marcadores", "store")
            ->name("admin.marcadores.store");

        Route::put("/admin/marcadores/{marcadores}", "update")
            ->name("admin.marcadores.update");

        Route::delete("/admin/marcadores/{marcadores}", "destroy")
            ->name("admin.marcadores.destroy");
    });

});
