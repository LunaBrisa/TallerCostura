<?php

use App\Http\Controllers\ControladorTipoPrenda;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;

Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
Route::get('/gestion/catalogo', function(){
    return view('Empleado/DashboardCatalogo');
});

// RUTAS PARA TIPOS DE PRENDA
Route::get('/gestion/tipos-prendas', [ControladorTipoPrenda::class, 'getTiposPrenda']);

Route::post('/agg/tipoprenda', [ControladorTipoPrenda::class, 'saveTipoPrenda']);

Route::get('/elim/tipo-prenda/{id}', [ControladorTipoPrenda::class, 'elimTipoPrenda']);
=======
Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedido.index');
>>>>>>> e767dc492e18caf4b2a0dc777eb71c1a7163b4b1
