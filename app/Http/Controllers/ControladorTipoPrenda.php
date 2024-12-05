<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveTipoPrendaRequest;
use App\Http\Requests\ModifTipoPrendaRequest;
use App\Models\TipoPrenda;
use Illuminate\Http\Request;
use tidy;

class ControladorTipoPrenda extends Controller
{
    public function getTiposPrenda() {
        $TipoPrendilla = TipoPrenda::paginate(3); 
        return view('Empleado/GestionTiposPrenda')->with("MisTiposPrenda", $TipoPrendilla);
    }
    

    public function saveTipoPrenda(SaveTipoPrendaRequest $saveTipoPrendaRequest){
        $TipoPrendaNuevo = new TipoPrenda();
        $TipoPrendaNuevo -> tipo_prenda = $saveTipoPrendaRequest -> tipoprendita;

        $TipoPrendaNuevo -> save();

        return redirect('/gestion/tipos-prendas')->with('success', '¡Se agregó el tipo de prenda correctamente!');
    }

    public function modifTipoPrenda(ModifTipoPrendaRequest $modifTipoPrendaRequest){
        $tipoPrenda = TipoPrenda::find($modifTipoPrendaRequest->get('idtp'));

        if ($tipoPrenda) {
            $tipoPrenda->tipo_prenda = $modifTipoPrendaRequest->get('tipoprendilla');
            $tipoPrenda->save();
        }

        return redirect('/gestion/tipos-prendas')->with('successmodif', '¡Se modifico el tipo de prenda correctamente!');
    }
}