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
}
