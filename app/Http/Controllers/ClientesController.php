<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use App\Models\Pedido;
use GuzzleHttp\Client;
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
}
