<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoPrenda;
use Illuminate\Http\Request;

class ControladorTipoPrenda extends Controller
{
    public function getTiposPrenda(){
        $TipoPrendilla = TipoPrenda::all();
        return view('Empleado/GestionTiposPrenda') -> with("MisTiposPrenda", $TipoPrendilla);
    }
}