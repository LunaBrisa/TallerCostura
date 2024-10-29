<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MaterialTela;
use Illuminate\Http\Request;

class TiposTelaController extends Controller
{
    public function getTiposTela(){
        $TipoTelilla = MaterialTela::all();
        return view('Empleado/DashboardTiposTela')->with('MisMaterialesTela', $TipoTelilla);
    }
}
