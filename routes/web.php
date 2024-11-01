<?php

use App\Http\Controllers\ColorController;
use App\Http\Controllers\ControladorTipoPrenda;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\TiposTelaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/gestion/catalogo', function(){
    return view('Empleado/DashboardCatalogo');
});

// RUTAS PARA TIPOS DE PRENDA
Route::get('/gestion/tipos-prendas', [ControladorTipoPrenda::class, 'getTiposPrenda']);

Route::post('/agg/tipoprenda', [ControladorTipoPrenda::class, 'saveTipoPrenda']);

Route::post('/agg/color', [ColorController::class, 'saveColor']);

Route::get('/gestion/tipos-telas', [TiposTelaController::class, 'getTiposTela']);

Route::post('agg/tipotela', [TiposTelaController::class, 'saveTipoTela']);

Route::get('/elim/material-tela/{id}', [TiposTelaController::class, 'elimMaterialTela']);

Route::get('/elim/tipo-prenda/{id}', [ControladorTipoPrenda::class, 'elimTipoPrenda']);
Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedido.index');
Route::get('/Pcatalogo', function () {
    return view('Cliente.PcatalogoView');
});

Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
Route::get('/pedidos/{id}', [PedidoController::class, 'show'])->name('pedidos.show');
