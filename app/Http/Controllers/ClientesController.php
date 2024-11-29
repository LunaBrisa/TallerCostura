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
use Illuminate\Auth\Events\Registered;
 

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
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido_p' => 'required|string|max:60',
            'apellido_m' => 'required|string|max:60',
            'telefono' => 'required|string|max:10',
            'compania' => 'nullable|string|max:100',
            'cargo' => 'nullable|min:3|max:100',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $user->sendEmailVerificationNotification();

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
            event(new Registered($user));
            return redirect()->route('clientes.index')
                ->with('success', 'Cliente y usuario agregado exitosamente con rol de Cliente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al crear el cliente: ' . $e->getMessage());
        }
    }

public function update(Request $request, $id)
{
    $request->validate([
        'nombre' => 'required|string|max:100',
        'apellido_p' => 'required|string|max:60',
        'apellido_m' => 'nullable|string|max:60',
        'telefono' => 'required|string|max:10',
        'compania' => 'nullable|string|max:100',
        'cargo' => 'min:3|max:100',
        'email' => 'required|email',
        'password' => 'nullable|string|min:6|confirmed', 
        'name' => 'required|string|max:255', 
    ]);

    try {
        $cliente = Cliente::findOrFail($id);
        $persona = $cliente->persona; 
        $user = $persona->user; 

        $user->name = $request->input('name'); 
        $user->email = $request->input('email'); 

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password')); 
        }

        $user->save(); 

        $persona->nombre = $request->input('nombre');
        $persona->apellido_p = $request->input('apellido_p');
        $persona->apellido_m = $request->input('apellido_m');
        $persona->telefono = $request->input('telefono');
        $persona->save();


        $cliente->compania = $request->input('compania');
        $cliente->cargo = $request->input('cargo');
        $cliente->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente y usuario actualizados exitosamente.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al actualizar el cliente: ' . $e->getMessage());
    }
}
public function show($id)
{
    $cliente = Cliente::with(['persona', 'persona.user', 'pedidos'])->findOrFail($id);
    
    return view('clientes.show', compact('cliente'));
}

}
