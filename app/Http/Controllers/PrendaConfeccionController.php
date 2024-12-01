<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\modifPrendaRequest;
use App\Models\PrendaConfeccion;
use App\Models\PrendaColor;
use App\Models\PrendaTela;
use App\Models\TipoPrenda;
use App\Models\Tela;
use App\Models\Color;
use App\Http\Requests\SavePrendaConfeccionRequest;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class PrendaConfeccionController extends Controller
{
    public function getPrendasConfeccion(){
        $prendillas = PrendaConfeccion::with(['tipoPrenda', 'prendasTelas', 'prendasTelas.tela', 'PrendasColor.color']) -> where('visible', 1) -> paginate(3);
        $prendillasOcultas = PrendaConfeccion::with(['tipoPrenda', 'prendasTelas', 'prendasTelas.tela', 'PrendasColor.color']) -> where('visible', 0) -> paginate(3);
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

    public function savePrendaConfeccion(SavePrendaConfeccionRequest $savePrendaConfeccionRequest)
    {
        $file = $savePrendaConfeccionRequest->file('ruta_imagen');

        if ($file && $file->isValid()) {
            // Reemplazar espacios en el nombre del archivo
            $filename = str_replace(' ', '_', basename($file->getClientOriginalName()));
        
            // Ruta absoluta de destino
            $destino = '/home/u769404724/public_html/images';
        
            // Mover archivo al destino
            $file->move($destino, $filename);
        
            // Generar la ruta relativa para guardar en la base de datos
            $filePath = 'images/' . $filename;


            DB::statement('CALL Crear_Prenda(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $savePrendaConfeccionRequest->nombreprendita,
                $savePrendaConfeccionRequest->descripcionprendita,
                $savePrendaConfeccionRequest->precio_obra_prendita,
                $savePrendaConfeccionRequest->generito,
                $savePrendaConfeccionRequest->tipoprendita,
                $filePath,  // Ruta relativa de la imagen
                $savePrendaConfeccionRequest->colorprendita,
                'pormientras',
                $savePrendaConfeccionRequest->telitas,
                $savePrendaConfeccionRequest->cantidadsitadetela,
            ]);
            return redirect('/gestion/prenda-confeccion')->with('success', '¡Se agregó la prenda correctamente!');
        }
        return redirect()->back()->with('error', 'Hubo un problema al subir la imagen.');
    }
    

    public function vistaPrendasConfeccion($id){
        return view('Empleado/ModificacionPrendaConfeccion')->with([
            'misPrendas' => PrendaConfeccion::find($id),
            'misTiposPrendas' => TipoPrenda::all()
        ]);
    }

    public function modifPrendaConfeccion(modifPrendaRequest $modifPrendaRequest){

        $prendaconfeccion = PrendaConfeccion::find($modifPrendaRequest -> idesote);

        if ($modifPrendaRequest -> nombreprendota != null){
            $prendaconfeccion -> nombre_prenda = $modifPrendaRequest -> nombreprendota;
        }

        if ($modifPrendaRequest -> descripcionprendota != null){
            $prendaconfeccion -> descripcion = $modifPrendaRequest -> descripcionprendota;
        }

        if ($modifPrendaRequest -> precioprendota != null){
            $prendaconfeccion -> precio_obra = $modifPrendaRequest -> precioprendota;
        }

        if ($modifPrendaRequest -> generote != null){
            $prendaconfeccion -> genero = $modifPrendaRequest -> generote;
        }

        if ($modifPrendaRequest -> tipoprendota != null){
            $prendaconfeccion -> tp_id = $modifPrendaRequest -> tipoprendota;
        }   

        $prendaconfeccion -> save();

        $tiposPrendas = TipoPrenda::all();
        $prenditas = PrendaConfeccion::with(['tipoPrenda', 'prendasTelas', 'prendasTelas.tela', 'PrendasColor.color']) -> where('visible', 1) -> get();
        $prenditasOcultas = PrendaConfeccion::with(['tipoPrenda', 'prendasTelas', 'prendasTelas.tela', 'PrendasColor.color']) -> where('visible', 0) -> get();
        $colores = Color::all();
        $telas = Tela::all();
        session()->flash('successmodif', '¡Se modificaron correctamente los datos!');
        return view('Empleado.DashboardPrendaConfeccion') -> with([
            'misPrendas' => $prenditas,
            'misPrendasOcultas' => $prenditasOcultas,
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
