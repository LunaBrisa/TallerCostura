<?php

namespace App\Http\Controllers;
use App\Models\Pedido; 

use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
{
    $pedidos = Pedido::with('usuario', 'empleado')->get();
    return view('pedidos.index', compact('pedidos')); // Incluye la relación de detalles del pedido
}
public function show($id)
    {
        $pedido = Pedido::with(['usuario', 'empleado', 'detallesConfeccion', 'detallesReparacion', 'detallesLote'])->findOrFail($id); // Incluye la relación de detalles del pedido
        return view('pedidos.show', compact('pedido'));
    }
}
