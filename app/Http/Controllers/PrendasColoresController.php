<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveColorPrendaRequest;
use App\Models\Color;
use App\Models\Prenda;
use App\Models\prenda_color;
use App\Models\PrendaColor;
use App\Models\PrendaConfeccion;
use Illuminate\Http\Request;

class PrendasColoresController extends Controller
{
    public function getColoresDePrenda($id){
        $prendasColores = PrendaColor::with('color')->where('prenda_id', $id)->get();
        $colores = Color::all();
        $prenda = PrendaConfeccion::find($id);
        return view('Empleado.ColoresDePrenda')->with([
            'misPrendasColores' => $prendasColores,
            'misColores' => $colores,
            'miPrenda' => $prenda
        ]);
    }

    public function saveColorPrenda(SaveColorPrendaRequest $saveColorPrendaRequest){
        $prendaColor = new PrendaColor();
        $prendaColor -> prenda_id = $saveColorPrendaRequest -> idprenda;
        $prendaColor -> color_id = $saveColorPrendaRequest -> colorprenda;
        $prendaColor -> ruta_imagen = "pormientras";
        
        $prendaColor -> save();
        
        return redirect('/gestion/prenda-confeccion');
    }

    public function eliminarColorPrenda($id){
        $prendaColor = PrendaColor::find($id);
        $prendaColor->delete();
        return redirect('/gestion/prenda-confeccion');
    }
}
