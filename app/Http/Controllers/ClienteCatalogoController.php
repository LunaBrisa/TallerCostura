<?php

namespace App\Http\Controllers;
use App\Models\prendas;

use Illuminate\Http\Request;

class ClienteCatalogoController extends Controller
{
  public function MostrarCatalogo(){
    $prenda = prendas::all();
    return view('Cliente.PcatalogoView',compact('prenda'));
  }
}
