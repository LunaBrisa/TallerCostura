<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard/pedidos', function(){
    return view('dashboard.pedidos');
});
