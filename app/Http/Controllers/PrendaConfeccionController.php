<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\modifPrendaRequest;
use App\Models\PrendaConfeccion;
use App\Models\PrendaColor;
use App\Models\PrendaTela;
use App\Models\TipoPrenda;
use App\Models\Tela;
use App\Models\Color;
use App\Http\Requests\SavePrendaConfeccionRequest;
use Illuminate\Http\Request;

class PrendaConfeccionController extends Controller
{
    public function getPrendasConfeccion(){
        $prendillas = PrendaConfeccion::with(['tipoPrenda', 'prendasTelas', 'prendasTelas.tela', 'PrendasColor.color']) -> where('visible', 1) -> get();
        $prendillasOcultas = PrendaConfeccion::with(['tipoPrenda', 'prendasTelas', 'prendasTelas.tela', 'PrendasColor.color']) -> where('visible', 0) -> get();
        $tiposprendilla = TipoPrenda::all();
        $telillas = Tela::all();
        $colorsillos = Color::all();

        return view('Empleado/DashboardPrendaConfeccion')->with([
            'misPrendas' => $prendillas,
            'misPrendasOcultas' => $prendillasOcultas,
            'misTiposPrendas' => $tiposprendilla,
            'misTelas' => $telillas,
            'misColores' => $colorsillos
        ]);
    }

    public function savePrendaConfeccion(SavePrendaConfeccionRequest $savePrendaConfeccionRequest){
        $prendaconfeccion = new PrendaConfeccion();
        $prendaconfeccion -> nombre_prenda = $savePrendaConfeccionRequest -> nombreprendita;
        $prendaconfeccion -> descripcion = $savePrendaConfeccionRequest -> descripcionprendita;
        $prendaconfeccion -> precio = $savePrendaConfeccionRequest -> precioprendita;
        $prendaconfeccion -> genero = $savePrendaConfeccionRequest -> generito;
        $prendaconfeccion -> tp_id = $savePrendaConfeccionRequest -> tipoprendita;
        $prendaconfeccion -> ruta_imagen = "pormientras";

        $prendaconfeccion -> save();

        $prendacolor = new PrendaColor();
        $prendacolor -> prenda_id = $prendaconfeccion -> id;
        $prendacolor -> color_id = $savePrendaConfeccionRequest -> colorprendita;
        $prendacolor -> ruta_imagen = "pormientras";
        
        $prendacolor -> save();

        $prendatela = new PrendaTela();
        $prendatela -> prenda_confeccion_id = $prendaconfeccion -> id;
        $prendatela -> tela_id = $savePrendaConfeccionRequest -> telitas;
        $prendatela -> cantidad_tela = $savePrendaConfeccionRequest -> cantidadsitadetela;

        $prendatela -> save();

        return redirect('/gestion/prenda-confeccion');
    }

    public function vistaPrendasConfeccion($id){
        return view('Empleado/ModificacionPrendaConfeccion')->with([
            'misPrendas' => PrendaConfeccion::find($id),
            'misTiposPrendas' => TipoPrenda::all()
        ]);
    }

    public function modifPrendaConfeccion(modifPrendaRequest $modifPrendaRequest){
        $prendaconfeccion = PrendaConfeccion::find($modifPrendaRequest->get('idesote'));
        
        if($prendaconfeccion){
            if($modifPrendaRequest -> filled('nombreprendota')){
                $prendaconfeccion->nombre_prenda = $modifPrendaRequest->get('nombreprendota');
            }

            if($modifPrendaRequest -> filled('descripcionprendota')){
                $prendaconfeccion->descripcion = $modifPrendaRequest->get('descripcionprendota');
            }

            if($modifPrendaRequest -> filled('precioprendota')){
                $prendaconfeccion -> precio = $modifPrendaRequest->get('precioprendota');
            }

            if($modifPrendaRequest -> filled('generote')){
                $prendaconfeccion -> genero = $modifPrendaRequest->get('generote');
            }

            if($modifPrendaRequest -> filled('tipoprendota')){
                $prendaconfeccion -> tp_id = $modifPrendaRequest->get('tipoprendota');
            }
            
            $prendaconfeccion->save();
        }

        $tiposPrendas = TipoPrenda::all();
        $prenditas = PrendaConfeccion::all();
        $colores = Color::all();
        $telas = Tela::all();
        return view('Empleado.DashboardPrendaConfeccion') -> with([
            'misPrendas' => $prenditas,
            'misTiposPrendas' => $tiposPrendas,
            'misColores' => $colores,
            'misTelas' => $telas
        ]);
    }

    public function ocultaPrenda($id){
        $prendaconfeccion = PrendaConfeccion::find($id);
        $prendaconfeccion -> visible = 0;
        $prendaconfeccion -> save();
        return redirect('/gestion/prenda-confeccion');
    }

    public function muestraPrenda($id){
        $prendaconfeccion = PrendaConfeccion::find($id);
        $prendaconfeccion -> visible = 1;
        $prendaconfeccion -> save();
        return redirect('/gestion/prenda-confeccion');
    }
}
