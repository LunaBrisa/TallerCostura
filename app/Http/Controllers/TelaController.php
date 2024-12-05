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
      
        $telillas = Tela::with('materialTela')->paginate(3); 
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
        $telota = Tela::find($modifTelaRequest->idtela);

        if ($modifTelaRequest->telilla != null){
            $telota->nombre_tela = $modifTelaRequest->telilla;
        }

        if ($modifTelaRequest->tipotelilla != null){
            $telota->material_tela_id = $modifTelaRequest->tipotelilla;
        }

        if ($modifTelaRequest->preciotelilla != null){
            $telota->precio = $modifTelaRequest->preciotelilla;
        }

        $telota -> save();

        return redirect('/gestion/tela')->with('successmodif', '¡Se modifico la tela correctamente!');
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
