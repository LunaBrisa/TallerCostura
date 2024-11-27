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
use App\Http\Controllers\EmpleadoRegistroController;
use App\Http\Controllers\PrendasColoresController;
use App\Http\Controllers\ServiciosController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProduccionController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\GestionUsuariosControllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\ClienteMiddleware;
use App\Http\Middleware\EmpleadoMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\UsuarioInformacion;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

// Página para pedir verificación
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// URL que se llama cuando se verifica el correo
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/'); // Redirige al lugar deseado después de verificar
})->middleware(['auth', 'signed'])->name('verification.verify');
// Reenvío de correo de verificación
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Correo de verificación enviado.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

use App\Http\Controllers\PerfilController;

// Rutas públicas
    Route::get('/', function () { return view('welcome');});
    Route::get('/Cliente/PcatalogoView', [ClienteCatalogoController::class, 'MostrarCatalogo'])->name('Cliente.PcatalogoView');
    Route::get('/Cliente/ClienteMujeresView', [ClienteCatalogoController::class, 'MostrarMujeres'])->name('Cliente.ClienteMujeresView');
    Route::get('/Cliente/ClienteHombresView', [ClienteCatalogoController::class, 'MostrarHombres'])->name('Cliente.ClienteHombresView');
    Route::post('/Cliente/DetallePrenda/{id}', [ClienteCatalogoController::class, 'DetallePrenda'])->name('Cliente.DetallePrenda');
// Rutas protegidas para admin
//Route::middleware([AdminMiddleware::class])->group(function () {
    Route::post('/Registro/RegistrarCliente', [ClienteRegistroController::class, 'RegistrarCliente'])->name('Registro.RegistrarCliente');
    Route::post('/Registro/RegistrarEmpleado', [EmpleadoRegistroController::class, 'RegistrarEmpleado'])->name('Registro.RegistrarEmpleado');
    Route::get('/gestion/catalogo', function(){return view('Empleado/DashboardCatalogo');});

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
    Route::get('/ocultar/prenda/{id}', [PrendaConfeccionController::class, 'ocultaPrenda']);
    Route::get('/mostrar/prenda/{id}', [PrendaConfeccionController::class, 'muestraPrenda']);

    //TELAS DE PRENDA
    Route::get('/elim/tela/prenda/{id}', [PrendasTelasController::class, 'eliminarTelaPrenda']);
    Route::get('/modificar/telas-prenda/{id}', [PrendasTelasController::class, 'getTelasDePrenda']);
    Route::post('/agreg/tela-prenda', [PrendasTelasController::class, 'saveTelaPrenda']);
    Route::post('/modif/cantidad-tela', [PrendasTelasController::class, 'modifCantidadTelaPrenda']); 

    //COLORES DE PRENDA  
    Route::get('/modificar/colores-prenda/{id}', [PrendasColoresController::class, 'getColoresDePrenda']);
    Route::post('/agreg/color-prenda', [PrendasColoresController::class, 'saveColorPrenda']);
    Route::get('/elim/color/prenda/{id}', [PrendasColoresController::class, 'eliminarColorPrenda']); 
    Route::post('/agg/tela-prenda', [PrendasTelasController::class, 'saveTelaPrenda']);

    //PEDIDOS
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedido.index');
//});

// Rutas protegidas para Empleados
//Route::middleware([EmpleadoMiddleware::class, AdminMiddleware::class])->group(function () {
    Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario.index');
    Route::post('/inventario', [InventarioController::class, 'store'])->name('inventario.store');
    Route::put('/inventario/{id}', [InventarioController::class, 'update'])->name('inventario.update');

    
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');
    Route::get('/pedidos/{id}', [PedidoController::class, 'show'])->name('pedidos.show');
    
    // Ruta para la vista de Gestión de Clientes
    Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
    Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
    Route::put('/clientes/{cliente}', [ClientesController::class, 'update'])->name('clientes.update');
    Route::get('/clientes/{id}', [ClientesController::class, 'show'])->name('clientes.show');
    
    Route::get('/dashboard', function (){ return view('dashboard.index');});
    Route::post('/empleados', [EmpleadosController::class, 'store'])->name('empleados.store');
    Route::get('/empleados', [EmpleadosController::class, 'index'])->name('empleados.index');
    Route::put('/empleados/{empleado}', [EmpleadosController::class, 'update'])->name('empleados.update');
    
    Route::get('/Servicios', [ServiciosController::class, 'index'])->name('Servicios.index');
    Route::post('Servicios', [ServiciosController::class, 'store'])->name('servicios.store');
    Route::get('Servicios/{id}/edit', [ServiciosController::class, 'edit'])->name('servicios.edit');
    Route::put('Servicios/{id}', [ServiciosController::class, 'update'])->name('servicios.update');
    Route::delete('Servicios/{id}', [ServiciosController::class, 'destroy'])->name('servicios.destroy');
//});

Route::get('/modificar/prenda/{id}', [PrendaConfeccionController::class, 'vistaPrendasConfeccion']);

Route::post('/modifi/prenda', [PrendaConfeccionController::class, 'modifPrendaConfeccion']);

Route::get('/ocultar/prenda/{id}', [PrendaConfeccionController::class, 'ocultaPrenda']);
Route::get('/mostrar/prenda/{id}', [PrendaConfeccionController::class, 'muestraPrenda']);

Route::get('/elim/tela/prenda/{id}', [PrendasTelasController::class, 'eliminarTelaPrenda']);

Route::post('/agg/tela-prenda', [PrendasTelasController::class, 'saveTelaPrenda']);

Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedido.index');
Route::get('/Pcatalogo', function () {
    return view('Cliente.PcatalogoView');
});
Route::get('/informacion', [UsuarioInformacion::class, 'consultarUsuario'])->name('informacion.consultarUsuario');
Route::get('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
    ->name('login'); // Ruta para mostrar el formulario de login

Route::post('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])
    ->name('login.store'); // Ruta para procesar el login

Route::get('/empleados', [EmpleadosController::class, 'index'])->name('empleados.index');
Route::post('/empleados', [EmpleadosController::class, 'store'])->name('empleados.store');
Route::put('/empleados/{empleado}', [EmpleadosController::class, 'update'])->name('empleados.update');
// Ruta para la vista de Gestión de Clientes
Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
Route::put('/clientes/{cliente}', [ClientesController::class, 'update'])->name('clientes.update');

Route::get('/dashboard', function (){ return view('dashboard.index');});
Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
Route::get('/pedidos', [PedidoController::class, 'show'])->name('pedidos.show');

// Rutas de autenticación (login/logout)
Route::get('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
    ->name('login'); // Ruta para mostrar el formulario de login

Route::post('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])
    ->name('login.store'); // Ruta para procesar el login

Route::post('logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->name('logout'); // Ruta para procesar el logout

    // Ruta para mostrar todos los servicios
Route::get('/servicios', [ServiciosController::class, 'index'])->name('servicios.index');

// Rutas para crear, actualizar y eliminar servicios
Route::post('/servicios', [ServiciosController::class, 'store'])->name('servicios.store');
Route::put('/servicios/{id}', [ServiciosController::class, 'update'])->name('servicios.update');
Route::put('/servicios/toggle/{id}', [ServiciosController::class, 'toggle'])->name('servicios.toggle');

// Nuevas rutas para ocultar y mostrar servicios
Route::put('/servicios/ocultar/{id}', [ServiciosController::class, 'ocultaServicio'])->name('servicios.ocultar');
Route::put('/servicios/mostrar/{id}', [ServiciosController::class, 'muestraServicio'])->name('servicios.mostrar');
    
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

Route::get('/perfil', [PerfilController::class, 'show'])->name('perfil')->middleware('auth');