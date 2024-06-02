<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ClaseController;
use App\Http\Controllers\EntrenadorController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect('/login');
});

// Rutas de autenticación
Auth::routes();

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('clases', ClaseController::class);
    Route::resource('entrenadores', EntrenadorController::class);
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::post('clases/{id}/asignar-alumno', [ClaseController::class, 'asignarAlumno'])->name('clases.asignarAlumno');
    Route::get('/dashboard/chart-data/{claseId}', [App\Http\Controllers\DashboardController::class, 'getChartData']);
    Route::get('/dashboard/membresia-data', [DashboardController::class, 'getMembresiaData']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
});