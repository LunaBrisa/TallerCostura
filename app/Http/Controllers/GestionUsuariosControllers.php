<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Usuario;

class GestionUsuariosControllers extends Controller
{
    public function index()
    {
        $personas = Persona::with('usuario')->get();
        
        return view('Administrador.GestionU', compact('personas'));
    }

    public function destroy($id)
{
    $persona = Persona::findOrFail($id);
    $persona->delete();

    return redirect()->route('personas.index')->with('success', 'Persona eliminada correctamente');
}

public function update(Request $request, $id)
{
    // Validar los datos recibidos del formulario
    $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido_p' => 'required|string|max:255',
        'apellido_m' => 'required|string|max:255',
        'telefono' => 'nullable|string|max:20',
        'correo' => 'required|email|max:255',
    ]);

    // Encontrar la persona y actualizar sus datos
    $persona = Persona::findOrFail($id);
    $persona->update($request->all());

    // Redireccionar de vuelta con un mensaje de éxito
    return redirect()->route('personas.index')->with('success', 'Datos de la persona actualizados correctamente');
}

public function store(Request $request)
{
    
    // Validación de los datos enviados desde el formulario
    $validatedData = $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido_p' => 'required|string|max:255',
        'apellido_m' => 'nullable|string|max:255',
        'telefono' => 'nullable|string|max:15',
        'correo' => 'required|email|max:255|unique:personas,correo',
    ]);

    // Crear una nueva instancia de Persona con los datos validados
    Persona::create($validatedData);

    // Redireccionar de vuelta a la página de gestión de usuarios con un mensaje de éxito
    return redirect()->route('personas.index')->with('success', 'Usuario agregado exitosamente.');
}


}
