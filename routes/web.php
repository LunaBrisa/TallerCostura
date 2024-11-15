<?php

use App\Http\Controllers\ColorController;
use App\Http\Controllers\ControladorTipoPrenda;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteCatalogoController;
use App\Http\Controllers\ClienteRegistroController;

Route::get('/', function () {
    return view('Welcome');
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
Route::post('/Cliente/DetallePrenda/{id}', [ClienteCatalogoController::class, 'DetallePrenda'])->name('Cliente.DetallePrenda');
Route::get('/Cliente/MostrarPrendasConColores', [ClienteCatalogoController::class, 'mostrarPrendasConColores'])->name('Cliente.MostrarPrendasConColores');
Route::get('/login', function (){
    return view('login');
});
Route::get('/mispedidos', function (){
    return view('Cliente.MisPedidos');
});