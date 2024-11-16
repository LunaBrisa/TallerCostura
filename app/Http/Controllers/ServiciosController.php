<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;


class ServiciosController extends Controller
{
    
    
        public function index()
{
    $servicios = Servicio::all(); // Obtiene todos los servicios
    return view('Servicios.ServiciosView', compact('servicios')); // Pasa la variable a la vista
}

public function store(Request $request)
{
    $request->validate([
        'servicio' => 'required|string|max:255',
        'descripcion' => 'required|string|max:255',
        'precio' => 'required|numeric',
        'visible' => 'required|boolean',
    ]);

    Servicio::create($request->all());

    return redirect()->route('Servicios.ServiciosView')->with('success', 'Servicio agregado correctamente');
}   

public function update(Request $request, $id)
{
    $request->validate([
        'servicio' => 'required|string|max:255',
        'descripcion' => 'required|string|max:255',
        'precio' => 'required|numeric',
        'visible' => 'required|boolean',
    ]);

    $servicio = Servicio::findOrFail($id);
    $servicio->update($request->all());

    return redirect()->route('Servicios.ServiciosView')->with('success', 'Servicio actualizado correctamente');
}

   
}
