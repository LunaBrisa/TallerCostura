<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DB;
use App\Http\Requests\PrendaTelaRequest;
use App\Http\Requests\modifCantidadTelaRequest;
use App\Models\PrendaTela;
use App\Models\PrendaConfeccion;
use App\Models\Tela;
use Illuminate\Http\Request;

class PrendasTelasController extends Controller
{
    public function getTelasDePrenda($id){
        $prendasTelas = PrendaTela::where(['prenda_id', $id])->with('prenda', 'tela')->get();
        $telitas = Tela::all();
        $prenda = PrendaConfeccion::find($id);
        return view('Empleado.TelasDePrenda')->with([
            'misPrendasTelas' => $prendasTelas,
            'misTelas' => $telitas,
            'miPrenda' => $prenda
        ]);
    }

    public function saveTelaPrenda(PrendaTelaRequest $prendaTelaRequest){
        $prendaTela = new PrendaTela();
        $prendaTela -> prenda_confeccion_id = $prendaTelaRequest -> idprenda;
        $prendaTela -> tela_id = $prendaTelaRequest -> telitaprendita;
        $prendaTela -> cantidad_tela = $prendaTelaRequest -> cantidadtelitaprenda;

        $prendaTela -> save();

        return redirect('/gestion/prenda-confeccion');
    }

    public function modifCantidadTelaPrenda(modifCantidadTelaRequest $modifCantidadTelaRequest){
        $prendaTela = PrendaTela::find($modifCantidadTelaRequest->get('idtela'));
        $prendaTela->cantidad_tela = $modifCantidadTelaRequest->get('cantidadsota');
        $prendaTela->save();
        return redirect('/gestion/prenda-confeccion');
    }

    public function eliminarTelaPrenda($id){

        $prendatela = PrendaTela::find($id);

        if ($prendatela) {
            PrendaTela::destroy($id);
        }
        
        return redirect('/gestion/prenda-confeccion');
    }
}
