<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Pedido;
use App\Models\Persona;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EmpleadosController extends Controller
{
    public function index(Request $request)
    {
        $pedidosPorEmpleado = Pedido::select('empleado_id', DB::raw('count(*) as cantidad_pedidos'))
            ->groupBy('empleado_id')
            ->orderBy('cantidad_pedidos', 'desc') 
            ->limit(3)
            ->get();
            $query = Empleado::query();
            if ($request->has('empleado')) {
                $empleado = $request->empleado;
                $query->whereHas('persona', function ($q) use ($empleado) {
                    $q->where(DB::raw("CONCAT(nombre, ' ', apellido_p, ' ', apellido_m)"), 'like', '%' . $empleado . '%');
                }); 
            }
            if ($request->has('estado')) {
                $estado = $request->estado;
            }
            $empleados = $query->with('persona')->get();
        
            $empleados2 = Empleado::with(['persona.user.roles'])->get();
            $roles = Rol::where('nombre_rol', '!=', 'Cliente')->get();
        return view('empleados.index', compact('empleados', 'pedidosPorEmpleado', 'empleados2', 'roles'));
    }
    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:100',
        'apellido_p' => 'required|string|max:60',
        'apellido_m' => 'nullable|string|max:60',
        'telefono' => 'required|string|max:10',
        'correo' => 'required|email|max:100',
        'fecha_nacimiento' => 'required|date',
        'rfc' => 'required|string|max:20',
        'nss' => 'required|string|max:20',
        'name' => 'required|string|max:30|unique:users,name',
        'contrasena' => 'required|string|min:6',
    ], [
        'name.unique' => 'El nombre de usuario ya está en uso.', // Mensaje personalizado para nombre de usuario único
        'contrasena.min' => 'La contraseña necesita al menos 6 caracteres.', // Mensaje personalizado para longitud mínima de contraseña
    ]);

    $usuario = User::create([
        'name' => $request->name,
        'contrasena' => Hash::make($request->contrasena),
        'visible' => 1,
    ]);

    $persona = Persona::create([
        'nombre' => $request->nombre,
        'apellido_p' => $request->apellido_p,
        'apellido_m' => $request->apellido_m,
        'telefono' => $request->telefono,
        'correo' => $request->correo,
        'usuario_id' => $usuario->id,
    ]);

    Empleado::create([
        'fecha_nacimiento' => $request->fecha_nacimiento,
        'rfc' => $request->rfc,
        'nss' => $request->nss,
        'persona_id' => $persona->id,
    ]);

    $empleadoRole = Rol::firstOrCreate(['nombre_rol' => 'empleado']);
    $usuario->roles()->attach($empleadoRole->id);

    return redirect()->route('empleados.index')->with('success', 'Empleado agregado exitosamente.');
}
public function update(Request $request, $id)
{
    $request->validate([
        'nombre' => 'required|string|max:100',
        'apellido_p' => 'required|string|max:100',
        'apellido_m' => 'required|string|max:100',
        'telefono' => 'required|string|max:10',
        'correo' => 'required|email|max:100',
        'fecha_nacimiento' => 'required|date',
        'rfc' => 'required|string|max:20',
        'nss' => 'required|string|max:20',
        'name' => 'required|string|max:100',
        'contrasena' => 'nullable|string|min:6',
        'rol_id' => 'required|exists:roles,id', 
    ]);

    $empleado = Empleado::findOrFail($id);
    // Actualizar datos de la persona
    $empleado->persona->update([
        'nombre' => $request->nombre,
        'apellido_p' => $request->apellido_p,
        'apellido_m' => $request->apellido_m,
        'telefono' => $request->telefono,
        'correo' => $request->correo,
    ]);

    $empleado->update([
        'fecha_nacimiento' => $request->fecha_nacimiento,
        'rfc' => $request->rfc,
        'nss' => $request->nss,
    ]);

    $usuario = $empleado->persona->usuario;
    $usuario->update([
        'name' => $request->name,
        'contrasena' => $request->filled('contrasena') ? Hash::make($request->contrasena) : $usuario->contrasena,
    ]);

    $usuario->roles()->sync([$request->rol_id]);

    return redirect()->route('empleados.index')->with('success', 'Empleado actualizado correctamente.');
}

}
