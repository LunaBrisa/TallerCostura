<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class UsuarioInformacion extends Controller
{
    public function consultarUsuario()
    {
        if(auth()->check()) {
        
         $id = Auth::user()->id;
         $result = DB::select('CALL Informacion_Usuario(?)', [$id]);    
    
         if (count($result) > 0) {   return view('informacion', ['datos' => $result]); } 
         else { return $error; }
           }  else
           return redirect()->route('login')->with('error', 'No se ha encontrado el usuario');


    }
    
}
