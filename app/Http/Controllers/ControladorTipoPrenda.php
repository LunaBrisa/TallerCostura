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

    public function elimTipoPrenda($id){      //ESTO NO VA A JALAR PQ PARA JALAR TENDRIA QUE BORRAR LA PRENDA EN EL DETALLE TAMBIEN

        // Encuentra las prendas asociadas al tipo de prenda
        $prendas = \DB::table('prendas_confecciones')->where('id', $id)->get();
        
        foreach ($prendas as $prenda) {
            // Elimina las relaciones en prenda_telas para cada prenda asociada
            \DB::table('prendas_telas')->where('id', $prenda->id)->delete();
        }
    
        // Ahora elimina las prendas relacionadas
        \DB::table('prendas_confecciones')->where('id', $id)->delete();
    
        TipoPrenda::destroy($id);
        return redirect('/gestion/tipos-prendas');
    }

}