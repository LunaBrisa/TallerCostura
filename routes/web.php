<?php

use App\Http\Controllers\ColorController;
use App\Http\Controllers\ControladorTipoPrenda;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteCatalogoController;
use App\Http\Controllers\ClienteRegistroController;
use App\Http\Controllers\ServiceController;


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
Route::get('/Cliente/ClienteMujeresView',[ClienteCatalogoController::class, 'MostrarMujeres'])->name('Cliente.ClienteMujeresView');
Route::get('/Cliente/ClienteHombresView', [ClienteCatalogoController::class, 'MostrarHombres'])->name('Cliente.ClienteHombresView');
Route::get('/Registro', function(){
    return view('Registro');
});
Route::post('/Registro/RegistrarCliente', [ClienteRegistroController::class, 'RegistrarCliente'])->name('Registro.RegistrarCliente');

// Rutas para la opcion de servicios 

Route::get('/servicios', [ServiceController::class, 'index'])->name('servicios.index');
Route::get('/servicios/create', [ServiceController::class, 'create'])->name('servicios.create');
Route::post('/servicios', [ServiceController::class, 'store'])->name('servicios.store');
Route::get('/servicios/{id}/edit', [ServiceController::class, 'edit'])->name('servicios.edit');
Route::put('/servicios/{id}', [ServiceController::class, 'update'])->name('servicios.update');
Route::delete('/servicios/{id}', [ServiceController::class, 'destroy'])->name('servicios.destroy');

