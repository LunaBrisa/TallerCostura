<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveTipoPrendaRequest;
use App\Models\TipoPrenda;
use Illuminate\Http\Request;
use tidy;

class ControladorTipoPrenda extends Controller
{
    public function getTiposPrenda(){
        $TipoPrendilla = TipoPrenda::all();
        return view('Empleado/GestionTiposPrenda') -> with("MisTiposPrenda", $TipoPrendilla);
    }

    public function saveTipoPrenda(SaveTipoPrendaRequest $saveTipoPrendaRequest){
        $TipoPrendaNuevo = new TipoPrenda();
        $TipoPrendaNuevo -> tipo_prenda = $saveTipoPrendaRequest -> tipoprendita;

        $TipoPrendaNuevo -> save();

        return redirect('/gestion/tipos-prendas');
    }

    public function elimTipoPrenda($id){
        TipoPrenda::destroy($id);
        return redirect('/gestion/tipos-prendas');
    }

}