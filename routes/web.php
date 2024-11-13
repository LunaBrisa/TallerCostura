<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProduccionController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\FinanzasController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\ClientesController;


Route::get('/', function () {
    return view('welcome');
});


// Ruta para la vista de Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Ruta para la vista de Pedidos
Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
Route::get('/pedidos/{id}', [PedidoController::class, 'show'])->name('pedidos.show');
Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');

// Ruta para la vista de Producción y Reparaciones
Route::get('/produccion', [ProduccionController::class, 'index'])->name('produccion.index');

// Ruta para la vista de Inventario de Insumos y Telas
Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario.index');

// Ruta para la vista del Dashboard Financiero
Route::get('/finanzas', [FinanzasController::class, 'index'])->name('finanzas.index');

// Ruta para la vista de Gestión de Empleados
Route::get('/empleados', [EmpleadosController::class, 'index'])->name('empleados.index');

// Ruta para la vista de Gestión de Clientes
Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');