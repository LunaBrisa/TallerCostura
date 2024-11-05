<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModifMateTelaRequest;
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

    public function modifMaterialTela(ModifMateTelaRequest $modifMateTelaRequest){
        $matetela = MaterialTela::find($modifMateTelaRequest->get('idmate'));

        if($matetela){
            $matetela->material_tela = $modifMateTelaRequest->get('materialtelilla');
            $matetela->save();
        }

        return redirect('/gestion/tipos-telas');
    }
}
