<?php

use App\Http\Controllers\ColorController;
use App\Http\Controllers\ControladorTipoPrenda;
use App\Http\Controllers\TiposTelaController;
use App\Http\Controllers\TelaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PrendaConfeccionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GestionUsuariosControllers;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/gestion/catalogo', function(){
    return view('Empleado/DashboardCatalogo');
});

// RUTAS PARA TIPOS DE PRENDA
Route::get('/gestion/tipos-prendas', [ControladorTipoPrenda::class, 'getTiposPrenda']);

Route::post('/agg/tipoprenda', [ControladorTipoPrenda::class, 'saveTipoPrenda']);

Route::post('/modif/tipo-prenda', [ControladorTipoPrenda::class, 'modifTipoPrenda']);

//RUTA PARA COLORES
Route::post('/agg/color', [ColorController::class, 'saveColor']);

//RUTAS PARA MATERIALES DE TELA
Route::get('/gestion/tipos-telas', [TiposTelaController::class, 'getTiposTela']);

Route::post('agg/tipotela', [TiposTelaController::class, 'saveTipoTela']);

Route::post('/modif/material-tela', [TiposTelaController::class, 'modifMaterialTela']);

//RUTAS PARA TELAS
Route::get('/gestion/tela', [TelaController::class, 'getTelas']);

Route::post('/agg/tela', [TelaController::class, 'saveTela']);

Route::post('/modif/tela', [TelaController::class, 'modifTela']);

//RUTAS PARA PRENDAS
Route::get('/gestion/prenda-confeccion', [PrendaConfeccionController::class, 'getPrendasConfeccion']);

Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedido.index');
Route::get('/Pcatalogo', function () {
    return view('Cliente.PcatalogoView');
});



Route::get('/GestionUsuarios', [GestionUsuariosControllers::class, 'index'])->name('usuarios.index');
Route::resource('personas', GestionUsuariosControllers::class);
Route::put('/personas/{id}', [GestionUsuariosControllers::class, 'update'])->name('personas.update');
Route::post('/personas', [GestionUsuariosControllers::class, 'store'])->name('personas.store');
