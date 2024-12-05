<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorImgRequest;
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
        $file = $saveColorPrendaRequest->file('imagencolorsote');

        if ($file && $file->isValid()) {
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());          
            $destino = base_path('../images');          
            $file->move($destino, $filename);         
            $filePath = 'images/' . $filename;
            
            DB::statement('CALL Agregar_Color_Prenda(?, ?, ?)', [
                $saveColorPrendaRequest -> colorprenda,
                $saveColorPrendaRequest -> idprenda,
                $filePath,
            ]);
    
            return redirect('/gestion/prenda-confeccion')->with('successColor', '¡Se agregó correctamente el color!');
        }
        return redirect('/gestion/prenda-confeccion')->with('errorColor', 'Hubo un problema al subir la imagen. Intente de nuevo. Si el problema persiste, contacte con nosotros.');
        
    }

    public function eliminarColorPrenda($id){
        $prendaColor = PrendaColor::find($id);
        $prendaColor->delete();
        return redirect('/gestion/prenda-confeccion')->with('successEliminarColor', '¡Se eliminó correctamente el color!');
    }

    public function modifImgColorPrenda(ColorImgRequest $modifImgColorPrendaRequest){
        $file = $modifImgColorPrendaRequest->file('imagencolorsillo');

        if ($file && $file->isValid()) {
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
           
            $destino = base_path('../images');
           
            $file->move($destino, $filename);
          
            $filePath = 'images/' . $filename;
            
            DB::statement('CALL Cambiar_Img_PC(?, ?)', [
                $modifImgColorPrendaRequest -> idprenda,
                $filePath,
            ]);
    
            return redirect('/gestion/prenda-confeccion')->with('successImgColor', '¡Se agregó correctamente la imagen al color!');
        }
        return redirect('/gestion/prenda-confeccion')->with('errorColor', 'Hubo un problema al subir la imagen. Intente de nuevo. Si el problema persiste, contacte con nosotros.');
    }
}
