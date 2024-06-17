<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ClaseController;
use App\Http\Controllers\EntrenadorController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('clientes', ClienteController::class);
    Route::resource('clases', ClaseController::class);
    Route::resource('entrenadores', EntrenadorController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('clases/{id}/asignar-alumno', [ClaseController::class, 'asignarAlumno'])->name('clases.asignarAlumno');
    Route::get('/dashboard/chart-data/{claseId}', [DashboardController::class, 'getChartData']);
    Route::get('/dashboard/membresia-data', [DashboardController::class, 'getMembresiaData']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});