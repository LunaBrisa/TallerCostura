<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index()
    {
        $pedidosPorCliente = Pedido::select('cliente_id', DB::raw('count(*) as cantidad_pedidos'))
            ->groupBy('cliente_id')
            ->orderBy('cantidad_pedidos', 'desc') 
            ->limit(3)
            ->get();
        $clientes = Cliente::with('persona')->get();
        
        return view('clientes.index', compact('clientes', 'pedidosPorCliente'));
    }
}
