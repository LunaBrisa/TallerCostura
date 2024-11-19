<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\InventarioController;
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

// Ruta para la vista de Inventario de Insumos y Telas
Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario.index');
Route::post('/inventario', [InventarioController::class, 'store'])->name('inventario.store');

// Ruta para la vista de Gestión de Empleados
Route::get('/empleados', [EmpleadosController::class, 'index'])->name('empleados.index');
Route::post('/empleados', [EmpleadosController::class, 'store'])->name('empleados.store');
Route::put('/empleados/{empleado}', [EmpleadosController::class, 'update'])->name('empleados.update');

// Ruta para la vista de Gestión de Clientes
Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
Route::put('/clientes/{cliente}', [ClientesController::class, 'update'])->name('clientes.update');
