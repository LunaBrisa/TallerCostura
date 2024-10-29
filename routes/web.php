<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteCatalogoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Cliente/PcatalogoView', [ClienteCatalogoController::class, 'MostrarCatalogo'])->name('Cliente.PcatalogoView');

