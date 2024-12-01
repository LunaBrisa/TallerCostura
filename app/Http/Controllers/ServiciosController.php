<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use Illuminate\Support\Facades\DB;

class ServiciosController extends Controller
{

public function index()
{
    // Obtener los servicios más usados
    $serviciosMasUsados = DB::table('REPARACIONES_SERVICIOS')
        ->select('servicio_id', DB::raw('count(*) as cantidad_usos'))
        ->groupBy('servicio_id')
        ->orderBy('cantidad_usos', 'desc')
        ->limit(3)
        ->get();

    // Adjuntar información del servicio (nombre, descripción, etc.)
    $serviciosMasUsados = $serviciosMasUsados->map(function ($item) {
        $servicio = Servicio::find($item->servicio_id);
        return [
            'servicio' => $servicio->servicio, // Nombre del servicio
            'cantidad_usos' => $item->cantidad_usos, // Cantidad de veces usado
        ];
    });

    // Obtener todos los servicios (para la tabla general)
    $servicios = Servicio::all();

    // Pasar las variables a la vista
    return view('Servicios.ServiciosView', compact('servicios', 'serviciosMasUsados'));
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
