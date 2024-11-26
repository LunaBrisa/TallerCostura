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
    public function store(Request $request){
    $request->validate([
        'nombre' => 'required|string|min:3|max:100',
        'apellido_p' => 'required|min:3|string|max:60',
        'apellido_m' => 'nullable|min:3|string|max:60',
        'telefono' => 'required|string|max:10',
        'fecha_nacimiento' => 'required|date',
        'rfc' => 'required|string|max:20',
        'nss' => 'required|string|max:20',
    ],);

    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
    ]);

    // Obtener el ID del usuario recién creado
    $user_id = $user->id;

    $nombre = $request->input('nombre');
    $apellido_p = $request->input('apellido_p');
    $apellido_m = $request->input('apellido_m');
    $telefono = $request->input('telefono');
    $fecha_nacimiento = $request->input('fecha_nacimiento');
    $rfc = $request->input('rfc');
    $nss = $request->input('nss');

    try {
        DB::statement('CALL crear_empleado(?, ?, ?, ?, ?, ?, ?, ?)', [
            $user_id,
            $nombre,
            $apellido_p,
            $apellido_m,
            $telefono,
            $fecha_nacimiento,
            $rfc,
            $nss,
        ]);

        return redirect()->route('empleados.index')->with('success', 'Empleado agregado exitosamente.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al crear el empleado: ' . $e->getMessage());
    }
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
        'nombre_usuario' => 'required|string|max:100',
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
        'nombre_usuario' => $request->nombre_usuario,
        'contrasena' => $request->filled('contrasena') ? Hash::make($request->contrasena) : $usuario->contrasena,
    ]);

    $usuario->roles()->sync([$request->rol_id]);

    return redirect()->route('empleados.index')->with('success', 'Empleado actualizado correctamente.');
}

}

