<?php

use App\Http\Controllers\ColorController;
use App\Http\Controllers\ControladorTipoPrenda;
use App\Http\Controllers\TiposTelaController;
use App\Http\Controllers\TelaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PrendaConfeccionController;
use App\Http\Controllers\PrendasTelasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteCatalogoController;
use App\Http\Controllers\ClienteRegistroController;
use App\Http\Controllers\ServiciosController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProduccionController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\GestionUsuariosControllers;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/Pcatalogo', function () {
    return view('Cliente.PcatalogoView');
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

Route::post('/agg/prenda-confeccion', [PrendaConfeccionController::class, 'savePrendaConfeccion']);

Route::get('/modificar/prenda/{id}', [PrendaConfeccionController::class, 'vistaPrendasConfeccion']);

Route::post('/modifi/prenda', [PrendaConfeccionController::class, 'modifPrendaConfeccion']);

Route::get('/elim/tela/prenda/{id}', [PrendasTelasController::class, 'eliminarTelaPrenda']);

Route::post('/agg/tela-prenda', [PrendasTelasController::class, 'saveTelaPrenda']);

Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedido.index');
Route::get('/Pcatalogo', function () {
    return view('Cliente.PcatalogoView');
});
Route::post('/Registro/RegistrarCliente', [ClienteRegistroController::class, 'RegistrarCliente'])->name('Registro.RegistrarCliente');


Route::get('/servicios', [ServiciosController::class, 'index'])->name('servicios.index');
Route::post('/servicios', [ServiciosController::class, 'store'])->name('servicios.store');
Route::put('/servicios/{id}', [ServiciosController::class, 'update'])->name('servicios.update');
Route::put('/servicios/toggle/{id}', [ServiciosController::class, 'toggle'])->name('servicios.toggle');


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
