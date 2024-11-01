<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveTipoTela;
use App\Models\MaterialTela;
use Illuminate\Http\Request;

class TiposTelaController extends Controller
{
    public function getTiposTela(){
        $TipoTelilla = MaterialTela::all();
        return view('Empleado/DashboardTiposTela')->with('MisMaterialesTela', $TipoTelilla);
    }

    public function saveTipoTela(SaveTipoTela $saveTipoTela){
        $TipoTelilla = new MaterialTela();

        $TipoTelilla->material_tela = $saveTipoTela->tipotelita;

        $TipoTelilla->save();

        return redirect('/gestion/tipos-telas');
    }

    public function elimMaterialTela($id){
        $telas = \DB::table('telas')->where('id_material_tela', $id)->get();

        foreach ($telas as $tela) {
            \DB::table('prenda_telas')->where('id_tela', $tela->id_tela)->delete();
        }

        \DB::table('telas')->where('id_material_tela', $id)->delete();

        MaterialTela::destroy($id);
        return redirect('/gestion/tipos-telas');
    }
}
