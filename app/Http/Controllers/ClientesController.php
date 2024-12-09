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
use App\Http\Requests\saveClientesRequest;
 

class ClientesController extends Controller
{
    public function index(Request $request)
    {
            $pedidosPorCliente = DB::table('PEDIDOS')
            ->join('CLIENTES', 'PEDIDOS.cliente_id', '=', 'CLIENTES.id')
            ->join('PERSONAS', 'CLIENTES.persona_id', '=', 'PERSONAS.id')
            ->select(
                DB::raw("PERSONAS.nombre AS cliente"),
                DB::raw('COUNT(PEDIDOS.id) as cantidad_pedidos')
            )
            ->whereMonth('PEDIDOS.fecha_pedido', now()->month)   
            ->whereYear('PEDIDOS.fecha_pedido', now()->year)    
            ->groupBy('cliente')
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
    public function store(saveClientesRequest $saveClientesRequest)
    {

        $user = User::create([
            'name' => $saveClientesRequest->input('name'),
            'email' => $saveClientesRequest->input('email'),
            'password' => bcrypt($saveClientesRequest->input('password')),
        ]);

        $user->sendEmailVerificationNotification();

        $user_id = $user->id;
    
        $nombre = $saveClientesRequest->input('nombre');
        $apellido_p = $saveClientesRequest->input('apellido_p');
        $apellido_m = $saveClientesRequest->input('apellido_m');
        $telefono = $saveClientesRequest->input('telefono');
        $compania = $saveClientesRequest->input('compania');
        $cargo = $saveClientesRequest->input('cargo');
    
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

public function update(saveClientesRequest $saveClientesRequest, $id)
{
    $saveClientesRequest->validate([
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

        $user->name = $saveClientesRequest->input('name'); 
        $user->email = $saveClientesRequest->input('email'); 

        if ($saveClientesRequest->filled('password')) {
            $user->password = bcrypt($saveClientesRequest->input('password')); 
        }

        $user->save(); 

        $persona->nombre = $saveClientesRequest->input('nombre');
        $persona->apellido_p = $saveClientesRequest->input('apellido_p');
        $persona->apellido_m = $saveClientesRequest->input('apellido_m');
        $persona->telefono = $saveClientesRequest->input('telefono');
        $persona->save();


        $cliente->compania = $saveClientesRequest->input('compania');
        $cliente->cargo = $saveClientesRequest->input('cargo');
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
