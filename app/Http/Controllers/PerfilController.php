<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Persona;

class PerfilController extends Controller
{
    public function perfil()
{
    // Obtiene el usuario autenticado
    $usuario = Auth::user();

    // Accede a los datos de la persona relacionada
    $persona = $usuario->persona;

    // Envía la información a la vista
    return view('cliente.perfil', compact('usuario', 'persona'));
}
}
