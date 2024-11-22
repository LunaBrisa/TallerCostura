<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Persona;
use App\Models\User;
use App\Models\Rol;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index(Request $request)
    {
        $pedidosPorCliente = Pedido::select('cliente_id', DB::raw('count(*) as cantidad_pedidos'))
            ->groupBy('cliente_id')
            ->orderBy('cantidad_pedidos', 'desc') 
            ->limit(3)
            ->get();
        
        $query = Cliente::query();
        // Filtrar por Nombre si se ha proporcionado
        if ($request->has('cliente')) {
            $cliente = $request->cliente;
            $query->whereHas('persona', function ($q) use ($cliente) {
                $q->where(DB::raw("CONCAT(nombre, ' ', apellido_p, ' ', apellido_m)"), 'like', '%' . $cliente . '%');
            }); // Búsqueda por Nombre
        }
        if ($request->has('estado')) {
            $estado = $request->estado;
        }
        $clientes = $query->with('persona')->get();
        return view('clientes.index', compact('clientes', 'pedidosPorCliente'));
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
        'compania' => 'nullable|string|max:100',
        'nombre_usuario' => 'required|string|max:30|unique:usuarios,nombre_usuario',
        'contrasena' => 'required|string|min:6',
    ], [
        'nombre_usuario.unique' => 'El nombre de usuario ya está en uso.', // Mensaje personalizado para nombre de usuario único
        'contrasena.min' => 'La contraseña necesita al menos 6 caracteres.', // Mensaje personalizado para longitud mínima de contraseña
    ]);

    // Crear el usuario
    $usuario = User::create([
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

    // Crear el cliente y asociarlo con la persona
    Cliente::create([
        'compania' => $request->compania,
        'persona_id' => $persona->id,
    ]);

    // Asignar el rol de "Cliente" al usuario
    $clienteRole = Rol::firstOrCreate(['nombre_rol' => 'Cliente']);
    $usuario->roles()->attach($clienteRole->id);

    // Redirigir con un mensaje de éxito
    return redirect()->route('clientes.index')->with('success', 'Cliente y usuario agregado exitosamente con rol de Cliente.');
}
public function update(Request $request, $id)
{
    // Validar los datos del formulario
    $request->validate([
        'nombre' => 'required|string|max:100',
        'apellido_p' => 'required|string|max:100',
        'apellido_m' => 'required|string|max:100',
        'telefono' => 'required|string|max:10',
        'correo' => 'required|email|max:100',
        'compania' => 'nullable|string|max:255',
        'cargo' => 'nullable|string|max:255',
        'nombre_usuario' => 'required|string|max:100',
        'contrasena' => 'nullable|string|min:6',
    ]);

    // Encontrar al cliente por ID
    $cliente = Cliente::findOrFail($id);

    // Actualizar los datos de persona
    $cliente->persona->update([
        'nombre' => $request->nombre,
        'apellido_p' => $request->apellido_p,
        'apellido_m' => $request->apellido_m,
        'telefono' => $request->telefono,
        'correo' => $request->correo,
    ]);

    // Actualizar datos de cliente
    $cliente->update([
        'compania' => $request->compania,
        'cargo' => $request->cargo,
    ]);

    // Actualizar datos de usuario
    $usuario = $cliente->persona->usuario; // Acceso a la relación usuario
    $usuario->update([
        'nombre_usuario' => $request->nombre_usuario,
        'contrasena' => $request->filled('contrasena') ? Hash::make($request->contrasena) : $usuario->contrasena,
    ]);

    // Redirigir con un mensaje de éxito
    return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
}
}
