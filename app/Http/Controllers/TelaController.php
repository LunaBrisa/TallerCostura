<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModifTelaRequest;
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

    public function saveTela(TelasRequest $telasRequest){ //VALIDADO DE Q YA YA TODO PROTEGIDO
        $telita = new Tela();
        $telita->nombre_tela = $telasRequest->telita;
        $telita->material_tela_id = $telasRequest->tipotelita;
        $telita->precio = $telasRequest->preciotelita;

        $telita->save();
        
        return redirect('/gestion/tela')->with('success', '¡Se agregó la tela correctamente!');
    }

    public function modifTela(ModifTelaRequest $modifTelaRequest){
        $telota = Tela::find($modifTelaRequest->get('idtela'));

        if($telota){
            $telota->nombre_tela = $modifTelaRequest->get('telilla');
            $telota->material_tela_id = $modifTelaRequest->get('tipotelilla');
            $telota->precio = $modifTelaRequest->get('preciotelilla');

            $telota->save();
        }

        return redirect('/gestion/tela');
    }





    public function mostrarVistaTelas()
{
    $telas = \App\Models\VistaTelas::all(); 

    return view('Empleado/VistaTelas', compact('telas')); 
}



public function mostrarVistaMateriales()
{
    $materiales = \App\Models\VistaMaterialesTelas::all(); 
    return view('Empleado/VistaMaterialesTelas', compact('materiales')); 
}



public function mostrarVistaTiposPrenda()
{
    $tipos = \App\Models\VistaTiposPrenda::all(); // Consultar datos de la vista
    return view('Empleado/VistaTiposPrenda', compact('tipos')); // Enviar datos a la vista
}





}
