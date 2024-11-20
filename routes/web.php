<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteCatalogoController;
use App\Http\Controllers\ClienteRegistroController;

use Illuminate\Support\Facades\Auth;

// Rutas públicas
Route::get('/', function () {
    return view('Welcome');
});

Route::get('/Pcatalogo', function () {
    return view('Cliente.PcatalogoView');
});
Route::get('/gestion/catalogo', function(){
    return view('Empleado/DashboardCatalogo');
});
Route::get('/Pcatalogo', function () {
    return view('Cliente.PcatalogoView');
});
Route::get('/Cliente/PcatalogoView', [ClienteCatalogoController::class, 'MostrarCatalogo'])->name('Cliente.PcatalogoView');
Route::get('/Cliente/ClienteMujeresView',[ClienteCatalogoController::class, 'MostrarMujeres'])->name('Cliente.ClienteMujeresView');
Route::get('/Cliente/ClienteHombresView', [ClienteCatalogoController::class, 'MostrarHombres'])->name('Cliente.ClienteHombresView');
Route::post('/Registro/RegistrarCliente', [ClienteRegistroController::class, 'RegistrarCliente'])->name('Registro.RegistrarCliente');
Route::post('/Cliente/DetallePrenda/{id}', [ClienteCatalogoController::class, 'DetallePrenda'])->name('Cliente.DetallePrenda');
Route::get('/Cliente/MostrarPrendasConColores', [ClienteCatalogoController::class, 'mostrarPrendasConColores'])->name('Cliente.MostrarPrendasConColores');
Route::get('/mispedidoscliente', [ClienteCatalogoController::class, 'MostrarPedidosClinte'])->name('Cliente.MostrarPedidosClinte');
// Rutas de autenticación (login/logout)
Route::get('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
    ->name('login'); // Ruta para mostrar el formulario de login

Route::post('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])
    ->name('login.store'); // Ruta para procesar el login

Route::post('logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->name('logout'); // Ruta para procesar el logout
