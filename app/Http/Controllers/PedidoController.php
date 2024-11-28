<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Pedido;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    private function obtenerEstadisticas()
    {
        $totalPedidos = Pedido::count();
        $pedidosEnProceso = Pedido::where('estado', 'pendiente')->count();
        $pedidosCompletados = Pedido::where('estado', 'completado')->count();
        $totalEnProceso = Pedido::where('estado', 'pendiente')->sum('total');
        $totalIngresos = Pedido::where('estado', 'completado')->sum('total');

        // Consultas adicionales
        $pedidosPorCliente = Pedido::select('cliente_id', DB::raw('count(*) as cantidad_pedidos'))
            ->groupBy('cliente_id')
            ->orderBy('cantidad_pedidos', 'desc')
            ->limit(3)
            ->get();

        $pedidosPorEmpleado = Pedido::select('empleado_id', DB::raw('count(*) as cantidad_pedidos'))
            ->groupBy('empleado_id')
            ->orderBy('cantidad_pedidos', 'desc')
            ->limit(3)
            ->get();

        $clientes = Cliente::all();
        $empleados = Empleado::all();

        return [
            'totalPedidos' => $totalPedidos,
            'pedidosEnProceso' => $pedidosEnProceso,
            'pedidosCompletados' => $pedidosCompletados,
            'totalIngresos' => $totalIngresos,
            'totalEnProceso' => $totalEnProceso,
            'pedidosPorCliente' => $pedidosPorCliente,
            'pedidosPorEmpleado' => $pedidosPorEmpleado,
            'clientes' => $clientes,
            'empleados' => $empleados
        ];
    }

    public function index(Request $request)
    {
        $query = Pedido::query();

        // Filtro por ID de orden
        if ($request->filled('orden')) {
            $orden = $request->orden;
            $query->where('id', 'like', '%' . $orden . '%');
        }

        // Filtro por nombre de cliente
        if ($request->filled('cliente')) {
            $cliente = $request->cliente;
            $query->whereHas('cliente.persona', function ($query) use ($cliente) {
                $query->where('nombre', 'like', '%' . $cliente . '%');
            });
        }

        // Filtro por estado
        if ($request->filled('estado')) {
            $estado = strtolower($request->estado);
            $query->where('estado', ucfirst($estado));
        }

        $pedidos = $query->with(['cliente', 'empleado'])->get();
        $estadisticas = $this->obtenerEstadisticas();

        return view('pedidos.index', compact('pedidos', 'estadisticas'));
    }

    public function detalles($id)
    {
        $pedido = Pedido::with(['empleado.persona', 'detallesConfecciones', 'detallesReparaciones.servicios', 'detallesLotes'])
                        ->findOrFail($id);
    
        return view('detalles', compact('pedido'));
    }
    
    
    public function store(Request $request)
    {
    $request->validate([
        'cliente' => 'required|exists:clientes,id',
        'empleado' => 'required|exists:empleados,id',
        'fecha_pedido' => 'required|date',
        'fecha_entrega' => 'required|date',
        'descripcion' => 'required|string',
        'detalles_lote' => 'nullable|array',
        'detalles_lote.*.prenda' => 'required|string',
        'detalles_lote.*.precio_por_prenda' => 'required|numeric',
        'detalles_lote.*.cantidad' => 'required|numeric',
        'detalles_lote.*.anticipo' => 'required|numeric',
        'reparacion_prendas' => 'nullable|array',
        'reparacion_descripciones' => 'nullable|array',
        'reparacion_cantidades' => 'nullable|array',
        'confeccion_prendas' => 'nullable|array',
        'confeccion_cantidades' => 'nullable|array',
    ]);

    $pedido = Pedido::create([
        'cliente_id' => $request->cliente,
        'empleado_id' => $request->empleado,
        'fecha_pedido' => $request->fecha_pedido,
        'fecha_entrega' => $request->fecha_entrega,
        'descripcion' => $request->descripcion,
        'estado' => 'Pendiente',
    ]);

    // Verificación para agregar detalles_lote solo si no están vacíos
    if ($request->filled('detalles_lote')) {
        foreach ($request->detalles_lote as $detalle) {
            if (!empty($detalle['prenda']) && !empty($detalle['precio_por_prenda']) && !empty($detalle['cantidad']) && !empty($detalle['anticipo'])) {
                $pedido->detallesLotes()->create([
                    'prenda' => $detalle['prenda'],
                    'precio_por_prenda' => $detalle['precio_por_prenda'],
                    'cantidad' => $detalle['cantidad'],
                    'anticipo' => $detalle['anticipo'],
                ]);
            }
        }
    }

    // Verificación para agregar detallesReparaciones solo si no están vacíos
    if ($request->filled('reparacion_prendas')) {
        foreach ($request->reparacion_prendas as $key => $reparacion) {
            if (!empty($reparacion) && !empty($request->reparacion_descripciones[$key])) {
                $pedido->detallesReparaciones()->create([
                    'prenda' => $reparacion,
                    'descripcion_problema' => $request->reparacion_descripciones[$key],
                    'cantidad_prenda' => $request->reparacion_cantidades[$key] ?? 1,
                ]);
            }
        }
    }

    // Verificación para agregar detallesConfecciones solo si no están vacíos
    if ($request->filled('confeccion_prendas')) {
        foreach ($request->confeccion_prendas as $key => $prenda) {
            if (!empty($prenda) && !empty($request->confeccion_cantidades[$key])) {
                $pedido->detallesConfecciones()->create([
                    'prenda_confeccion_id' => $prenda,
                    'cantidad_prenda' => $request->confeccion_cantidades[$key],
                    'subtotal' => $request->confeccion_cantidades[$key], // Ajustar si se necesita cálculo de precio
                ]);
            }
        }
    }

    return redirect()->route('pedidos.index')->with('success', 'Pedido creado exitosamente.');
}

}
