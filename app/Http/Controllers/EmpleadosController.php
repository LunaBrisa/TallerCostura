<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EmpleadosController extends Controller
{
    public function index(Request $request)
    {
        $pedidosPorEmpleado = Pedido::select('empleado_id', DB::raw('count(*) as cantidad_pedidos'))
            ->groupBy('empleado_id')
            ->orderBy('cantidad_pedidos', 'desc') 
            ->limit(3)
            ->get();
            $query = Empleado::query();
            // Filtrar por Nombre si se ha proporcionado
            if ($request->has('empleado')) {
                $empleado = $request->empleado;
                $query->whereHas('persona', function ($q) use ($empleado) {
                    $q->where(DB::raw("CONCAT(nombre, ' ', apellido_p, ' ', apellido_m)"), 'like', '%' . $empleado . '%');
                }); // Búsqueda por Nombre
            }
            if ($request->has('estado')) {
                $estado = $request->estado;
            }
            $empleados = $query->with('persona')->get();
        
        return view('empleados.index', compact('empleados', 'pedidosPorEmpleado'));
    }
}
