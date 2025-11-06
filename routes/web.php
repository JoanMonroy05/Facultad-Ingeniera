<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EstudianteController;
use Illuminate\Support\Facades\Route;

// Ruta al dashboard principal (solo usuarios verificados)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 🔒 Rutas protegidas (solo autenticados)
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🔐 Rutas para administradores
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('estudiantes', EstudianteController::class);
});

require __DIR__.'/auth.php';