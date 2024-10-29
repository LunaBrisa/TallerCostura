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

        // Encuentra las prendas asociadas al tipo de prenda
        $prendas = \DB::table('prendas')->where('id_tp', $id)->get();
        
        foreach ($prendas as $prenda) {
            // Elimina las relaciones en prenda_telas para cada prenda asociada
            \DB::table('prenda_telas')->where('id_prenda', $prenda->id_prenda)->delete();
        }
    
        // Ahora elimina las prendas relacionadas
        \DB::table('prendas')->where('id_tp', $id)->delete();
    
        TipoPrenda::destroy($id);
        return redirect('/gestion/tipos-prendas');
    }

}