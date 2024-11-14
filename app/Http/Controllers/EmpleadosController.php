<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EmpleadosController extends Controller
{
    public function index()
    {
        $pedidosPorEmpleado = Pedido::select('empleado_id', DB::raw('count(*) as cantidad_pedidos'))
            ->groupBy('empleado_id')
            ->orderBy('cantidad_pedidos', 'desc') 
            ->limit(3)
            ->get();
        $empleados = Empleado::with('persona')->get();
        
        return view('empleados.index', compact('empleados', 'pedidosPorEmpleado'));
    }
}
