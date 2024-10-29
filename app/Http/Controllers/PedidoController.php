<?php

namespace App\Http\Controllers;
use App\Models\Pedidos; 

use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
{
    $pedidos = Pedidos::with('usuario', 'empleado')->get();
    return view('dashboard.pedidos', compact('pedidos'));
}

}
