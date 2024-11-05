<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PrendaConfeccion;
use Illuminate\Http\Request;

class PrendaConfeccionController extends Controller
{
    public function getPrendasConfeccion(){
        $prendillas = PrendaConfeccion::with('tipoPrenda')->get();

        return view('Empleado/DashboardPrendaConfeccion')->with('misPrendas', $prendillas);
    }
}
