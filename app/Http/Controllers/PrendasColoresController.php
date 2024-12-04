<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveColorPrendaRequest;
use App\Models\Color;
use App\Models\PrendaColor;
use App\Models\PrendaConfeccion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PrendasColoresController extends Controller
{
    public function getColoresDePrenda($id){

        $colores = Color::all();
        $prenda = PrendaConfeccion::find($id);
        $prendasColores = DB::select('SELECT COLORES.color AS color, PRENDAS_COLORES.ruta_imagen,
        PRENDAS_COLORES.id AS id FROM COLORES INNER JOIN 
        PRENDAS_COLORES ON PRENDAS_COLORES.color_id = COLORES.id
        INNER JOIN PRENDAS_CONFECCIONES ON PRENDAS_CONFECCIONES.id = PRENDAS_COLORES.prenda_id
        WHERE PRENDAS_CONFECCIONES.id IN (SELECT PRENDAS_COLORES.prenda_id FROM PRENDAS_COLORES WHERE
        PRENDAS_COLORES.prenda_id = ?)', [$id]);

        return view('Empleado.ColoresDePrenda')->with([
            'misPrendasColores' => $prendasColores,
            'misColores' => $colores,
            'miPrenda' => $prenda
        ]);
    }

    public function saveColorPrenda(SaveColorPrendaRequest $saveColorPrendaRequest){
        $prendaColor = new PrendaColor();

        $file = $saveColorPrendaRequest -> file('imagencolorsote');

        if ($file && $file->isValid()) {
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
    
            $destino = base_path('../images');
    
            $file->move($destino, $filename);
    
            $filePath = 'images/' . $filename;
    
            $prendaColor -> ruta_imagen = $filePath;
            $prendaColor -> prenda_id = $saveColorPrendaRequest -> idprenda;
            $prendaColor -> color_id = $saveColorPrendaRequest -> colorprenda;        
            $prendaColor -> save();
             
            return redirect('/gestion/prenda-confeccion')->with('successColor', '¡Se agregó correctamente el color!');
        }else{
            return redirect('/gestion/prenda-confeccion')->with('errorColor', 'Hubo un problema al subir la imagen. Intente de nuevo.');
        }
    }

    public function eliminarColorPrenda($id){
        $prendaColor = PrendaColor::find($id);
        $prendaColor->delete();
        return redirect('/gestion/prenda-confeccion')->with('successEliminarColor', '¡Se eliminó correctamente el color!');
    }
}
