<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;

class ServiciosController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all(); // Obtiene todos los servicios
        return view('servicios.ServiciosView', compact('servicios')); // Pasa la variable a la vista
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

    // Alterna entre ocultar y mostrar el servicio
    public function toggle($id)
    {
        $servicio = Servicio::find($id);
        if ($servicio) {
            $servicio->visible = !$servicio->visible;  // Alterna entre 1 y 0
            $servicio->save();
        }
        return redirect()->route('servicios.index');  // O la ruta que redirige a la lista de servicios
    }
    
   // Ocultar servicio
public function ocultaServicio($id)
{
    $servicio = Servicio::find($id);
    if ($servicio) {
        $servicio->visible = 0; // Marca el servicio como no visible
        $servicio->save();
    }
    return redirect()->route('servicios.index');
}

// Mostrar servicio
public function muestraServicio($id)
{
    $servicio = Servicio::find($id);
    if ($servicio) {
        $servicio->visible = 1; // Marca el servicio como visible
        $servicio->save();
    }
    return redirect()->route('servicios.index');
}

}
