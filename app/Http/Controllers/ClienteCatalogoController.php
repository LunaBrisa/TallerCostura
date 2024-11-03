<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\prenda;

class ClienteCatalogoController extends Controller
{
  public function MostrarCatalogo(){
    $prenda = prenda::all();
    return view('Cliente.PcatalogoView',compact('prenda'));
  }
  public function MostrarMujeres(){
    $prenda = prenda::where('genero','=','Mujer')->get();
    return view('Cliente.ClienteMujeresView',compact('prenda'));
  }
  public function MostrarHombres(){
    $prenda = prenda::where('genero','=','Hombre')->get();
    return view('Cliente.ClienteHombresView',compact('prenda'));
  }
}
