<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Pedido;
use App\Models\Persona;
use App\Models\Rol;
use App\Models\Usuario;
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
            // Filtrar por Nombre si se ha proporcionado
            if ($request->has('empleado')) {
                $empleado = $request->empleado;
                $query->whereHas('persona', function ($q) use ($empleado) {
                    $q->where(DB::raw("CONCAT(nombre, ' ', apellido_p, ' ', apellido_m)"), 'like', '%' . $empleado . '%');
                }); // Búsqueda por Nombre
            }
            if ($request->has('estado')) {
                $estado = $request->estado;
            }
            $empleados = $query->with('persona')->get();
        
        return view('empleados.index', compact('empleados', 'pedidosPorEmpleado'));
    }
    public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'nombre' => 'required|string|max:100',
        'apellido_p' => 'required|string|max:60',
        'apellido_m' => 'nullable|string|max:60',
        'telefono' => 'required|string|max:10',
        'correo' => 'required|email|max:100',
        'fecha_nacimiento' => 'required|date',
        'rfc' => 'required|string|max:10',
        'nss' => 'required|string|max:10',
        'nombre_usuario' => 'required|string|max:30|unique:usuarios,nombre_usuario',
        'contrasena' => 'required|string|min:6',
    ], [
        'nombre_usuario.unique' => 'El nombre de usuario ya está en uso.', // Mensaje personalizado para nombre de usuario único
        'contrasena.min' => 'La contraseña necesita al menos 6 caracteres.', // Mensaje personalizado para longitud mínima de contraseña
    ]);

    // Crear el usuario
    $usuario = Usuario::create([
        'nombre_usuario' => $request->nombre_usuario,
        'contrasena' => Hash::make($request->contrasena),
        'visible' => 1,
    ]);

    // Crear la persona y asociarla con el usuario
    $persona = Persona::create([
        'nombre' => $request->nombre,
        'apellido_p' => $request->apellido_p,
        'apellido_m' => $request->apellido_m,
        'telefono' => $request->telefono,
        'correo' => $request->correo,
        'usuario_id' => $usuario->id,
    ]);

    // Crear el empleado y asociarlo con la persona
    Empleado::create([
        'fecha_nacimiento' => $request->fecha_nacimiento,
        'rfc' => $request->rfc,
        'nss' => $request->nss,
        'persona_id' => $persona->id,
    ]);

    // Asignar el rol
    $empleadoRole = Rol::firstOrCreate(['nombre_rol' => 'empleado']);
    $usuario->roles()->attach($empleadoRole->id);

    // Redirigir con un mensaje de éxito
    return redirect()->route('empleados.index')->with('success', 'Cliente y usuario agregado exitosamente con rol de Cliente.');
}
}
