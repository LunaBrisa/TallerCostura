<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MaterialTela;
use App\Models\Tela;
use App\Http\Requests\TelasRequest;
use Illuminate\Http\Request;

class TelaController extends Controller
{
    public function getTelas(){
        $telillas = Tela::with('materialTela')->get();
        $mate_telas = MaterialTela::all();

        return view('Empleado/DashboardTelas')->with([
            'misTelas' => $telillas,
            'misMaterialTela' => $mate_telas
        ]);
    }

    public function saveTela(TelasRequest $telasRequest){
        $telita = new Tela();
        $telita->nombre_tela = $telasRequest->telita;
        $telita->material_tela_id = $telasRequest->tipotelita;

        $telita->save();
        
        return redirect('/gestion/tela');
    }
}
