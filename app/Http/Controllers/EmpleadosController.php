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
use App\Http\Requests\saveEmpleadosRequest;

class EmpleadosController extends Controller
{
    public function index(Request $request)
    {
        $pedidosPorEmpleado = DB::table('PEDIDOS')
    ->join('EMPLEADOS', 'PEDIDOS.empleado_id', '=', 'EMPLEADOS.id')
    ->join('PERSONAS', 'EMPLEADOS.persona_id', '=', 'PERSONAS.id')
    ->select(
        DB::raw("PERSONAS.nombre AS empleado"),
        DB::raw('COUNT(PEDIDOS.id) as cantidad_pedidos')
    )
    ->whereMonth('PEDIDOS.fecha_pedido', now()->month)   // Filtrar por el mes actual
    ->whereYear('PEDIDOS.fecha_pedido', now()->year)     // Filtrar por el año actual
    ->groupBy('empleado')
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
    public function store(saveEmpleadosRequest $saveEmpleadosRequest)
    {
        
    $user = User::create([
        'name' => $saveEmpleadosRequest->input('name'),
        'email' => $saveEmpleadosRequest->input('email'),
        'password' => bcrypt($saveEmpleadosRequest->input('password')),
    ]);

    $user->sendEmailVerificationNotification();

    $user_id = $user->id;

    $nombre = $saveEmpleadosRequest->input('nombre');
    $apellido_p = $saveEmpleadosRequest->input('apellido_p');
    $apellido_m = $saveEmpleadosRequest->input('apellido_m');
    $telefono = $saveEmpleadosRequest->input('telefono');
    $fecha_nacimiento = $saveEmpleadosRequest->input('fecha_nacimiento');
    $rfc = $saveEmpleadosRequest->input('rfc');
    $nss = $saveEmpleadosRequest->input('nss');

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
        'email' => 'required|email|max:100',
        'rol_id' => 'required|exists:roles,id', 
    ]);

    $empleado = Empleado::findOrFail($id);
    // Actualizar datos de la persona
    $empleado->persona->update([
        'nombre' => $request->nombre,
        'apellido_p' => $request->apellido_p,
        'apellido_m' => $request->apellido_m,
        'telefono' => $request->telefono,
    ]);

    $usuario = $empleado->persona->user;
    $usuario->update([
        'email' => $request->email,
    ]);

    $usuario->roles()->sync([$request->rol_id]);

    return redirect()->route('empleados.index')->with('success', 'Empleado actualizado correctamente.');
}
public function show($id)
{
    $empleado = Empleado::with(['persona', 'persona.user', 'pedidos'])->findOrFail($id);
    
    return view('empleados.show', compact('empleado'));
}
}

