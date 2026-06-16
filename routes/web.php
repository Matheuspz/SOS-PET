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

Route::get('/api/marcadores', [MarcadoresController::class, 'index'])
    ->name('api.marcadores');
Route::get('/api/eventos', [EventosController::class, 'index'])
    ->name('api.eventos');
Route::get('/api/dicas', [DicasController::class, 'index'])
    ->name('api.dicas');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
    Route::post('/admin/logout', AdminLogoutController::class)
        ->name('admin.logout');

    Route::controller(EventosController::class)->group(function () {

        Route::post("/admin/eventos", "store")
            ->name("admin.eventos.store");

        Route::get("/admin/eventos/{id}/edit", "edit")
            ->name("admin.eventos.edit");
        Route::put("/admin/eventos/{eventos}", "update")
            ->name("admin.eventos.update");

        Route::delete("/admin/eventos/{eventos}", "destroy")
            ->name("admin.eventos.destroy");
    });
    Route::controller(DicasController::class)->group(function () {

        Route::post("/admin/dicas", "store")
            ->name("admin.dicas.store");

        Route::get("/admin/dicas/{dicas}/edit", "edit")
            ->name("admin.dicas.edit");
        Route::put("/admin/dicas/{dicas}", "update")
            ->name("admin.dicas.update");


        Route::delete("/admin/dicas/{dicas}", "destroy")
            ->name("admin.dicas.destroy");
    });
    Route::controller(MarcadoresController::class)->group(function () {

        Route::post("/admin/marcadores", "store")
            ->name("admin.marcadores.store");

        Route::get('/admin/marcadores/{marcadores}/edit', 'edit')
            ->name("admin.marcadores.edit");
        Route::put("/admin/marcadores/{marcadores}", "update")
            ->name("admin.marcadores.update");

        Route::delete("/admin/marcadores/{marcadores}", "destroy")
            ->name("admin.marcadores.destroy");
    });

});
