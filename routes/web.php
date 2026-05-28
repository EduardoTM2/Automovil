<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AutomovilController;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\AsesorVentaController;
use App\Http\Controllers\OficialCreditoController;
use Illuminate\Support\Facades\Route;

// Pantalla de bienvenida (Pública)
Route::get('/', function () {
    return view('welcome');
});

// Panel de control (Privado)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 🔒 TODAS ESTAS RUTAS REQUIEREN AUTENTICACIÓN
Route::middleware('auth')->group(function () {
    
    // Rutas del Perfil de Usuario (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🚀 MÓDULOS DEL SISTEMA (CRUDs Completos)
    Route::resource('clientes', ClienteController::class);
    Route::resource('automoviles', AutomovilController::class);
    Route::resource('creditos', CreditoController::class);
    Route::resource('pagos', PagoController::class);
    Route::resource('facturas', FacturaController::class);
    Route::resource('asesores', AsesorVentaController::class);
    Route::resource('oficiales', OficialCreditoController::class);
});

require __DIR__.'/auth.php';