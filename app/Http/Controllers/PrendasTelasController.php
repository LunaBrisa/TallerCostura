<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PrendaTela;
use Illuminate\Http\Request;

class PrendasTelasController extends Controller
{
    public function eliminarTelaPrenda($id){
        $prendatela = PrendaTela::find($id);
        $prendatela::destroy($id);
        return redirect('/gestion/prenda-confeccion');
    }
}
