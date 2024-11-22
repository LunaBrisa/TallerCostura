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
        'compania' => 'nullable|string|max:100',
        'name' => 'required|string|max:30|unique:usuarios,nombre_usuario',
    ], [
        'name.unique' => 'El nombre de usuario ya está en uso.', // Mensaje personalizado para nombre de usuario único
        'contrasena.min' => 'La contraseña necesita al menos 6 caracteres.', // Mensaje personalizado para longitud mínima de contraseña
    ]);

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
    $compania = $request->input('compania');
    $cargo = $request->input('cargo');

    try {
        DB::statement('CALL crear_cliente(?, ?, ?, ?, ?, ?, ?)', [
            $user_id,
            $nombre,
            $apellido_p,
            $apellido_m,
            $telefono,
            $compania,
            $cargo,
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente y usuario agregado exitosamente con rol de Cliente.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al crear el cliente: ' . $e->getMessage());
    }
    // Redirigir con un mensaje de éxito
}
public function update(Request $request, $id)
{
    // Validar los datos del formulario
    $request->validate([
        'nombre' => 'required|string|max:100',
        'apellido_p' => 'required|string|max:100',
        'apellido_m' => 'required|string|max:100',
        'telefono' => 'required|string|max:10',
        'email' => 'required|email|max:100',
        'compania' => 'nullable|string|max:255',
        'cargo' => 'nullable|string|max:255',
        'name' => 'required|string|max:100',
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
        'email' => $request->correo,
    ]);

    // Actualizar datos de cliente
    $cliente->update([
        'compania' => $request->compania,
        'cargo' => $request->cargo,
    ]);

    // Actualizar datos de usuario
    $usuario = $cliente->persona->user; // Acceso a la relación usuario
    $usuario->update([
        'name' => $request->name,
        'contrasena' => $request->filled('contrasena') ? Hash::make($request->contrasena) : $usuario->contrasena,
    ]);

    // Redirigir con un mensaje de éxito
    return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
}
}
