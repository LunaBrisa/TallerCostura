<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
Route::get('/pedidos/{id}', [PedidoController::class, 'show'])->name('pedidos.show');
