<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Pcatalogo', function () {
    return view('Cliente.PcatalogoView');
});

