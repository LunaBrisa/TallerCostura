<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Servicio;


class ServiceController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all();
        return view('servicios.index', compact('servicios'));
    }

    public function create()
    {
        return view('servicios.create'); // La vista del formulario para crear un servicio
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
        ]);

        Servicio::create($request->all());
        return redirect()->back()->with('success', 'Servicio agregado exitosamente'); 
    }

    public function edit($id)
    {
        return view('servicios.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
        ]);

        $servicio = Servicio::findOrFail($id);
        $servicio->update($request->all());
        return redirect()->back()->with('success', 'Servicio actualizado exitosamente');
    }

    public function destroy($id)
    {
        $servicio = Servicio::findOrFail($id);
        $servicio->delete();
        return redirect()->back()->with('success', 'Servicio eliminado exitosamente');  
    }
}


