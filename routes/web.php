<?php

use App\Http\Controllers\ColorController;
use App\Http\Controllers\ControladorTipoPrenda;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteCatalogoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Pcatalogo', function () {
    return view('Cliente.PcatalogoView');
});
Route::get('/gestion/catalogo', function(){
    return view('Empleado/DashboardCatalogo');
});
Route::get('/Cliente/PcatalogoView', [ClienteCatalogoController::class, 'MostrarCatalogo'])->name('Cliente.PcatalogoView');
Route::get('/Cliente/ClienteMujeresView', function(){
    return view('Cliente.ClienteMujeresView');
});
Route::get('/Cliente/ClienteHombresView', function(){
    return view('Cliente.ClienteHombresView');
});

// RUTAS PARA TIPOS DE PRENDA
Route::get('/gestion/tipos-prendas', [ControladorTipoPrenda::class, 'getTiposPrenda']);

Route::post('/agg/tipoprenda', [ControladorTipoPrenda::class, 'saveTipoPrenda']);

Route::post('/agg/color', [ColorController::class, 'saveColor']);

Route::get('/elim/tipo-prenda/{id}', [ControladorTipoPrenda::class, 'elimTipoPrenda']);
Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedido.index');
Route::get('/Pcatalogo', function () {
    return view('Cliente.PcatalogoView');
});
