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

    return redirect()->route('servicios.index')->with('success', 'Servicio agregado correctamente');

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

    return redirect()->route('servicios.index')->with('success', 'Servicio actualizado correctamente');

}

public function toggle($id)
{
    $servicio = Servicio::find($id);
    if ($servicio) {
        $servicio->visible = !$servicio->visible;  // Alterna entre 1 y 0
        $servicio->save();
    }
    return redirect()->route('servicios.index');  // O la ruta que redirige a la lista de servicios
}

}
