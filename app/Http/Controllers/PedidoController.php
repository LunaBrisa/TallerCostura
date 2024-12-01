<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Pedido;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PedidoController extends Controller
{
    private function obtenerEstadisticas()
    {
        $inicioMes = Carbon::now()->startOfMonth(); // Primer día del mes actual
        $finMes = Carbon::now()->endOfMonth(); // Último día del mes actual
    
        // Contar pedidos pendientes sin importar la fecha
        $pedidosEnProceso = Pedido::where('estado', 'pendiente')->count();
    
    
        // Contar completados solo del mes
        $pedidosCompletados = Pedido::where('estado', 'completado')
            ->whereBetween('updated_at', [$inicioMes, $finMes])
            ->count();
    
        // Calcular ingresos solo del mes
        $totalIngresos = Pedido::where('estado', 'completado')
            ->whereBetween('updated_at', [$inicioMes, $finMes])
            ->sum('total');
    
        $clientes = Cliente::all();
        $empleados = Empleado::all();
    
        return [
            'pedidosEnProceso' => $pedidosEnProceso,
            'pedidosCompletados' => $pedidosCompletados,
            'totalIngresos' => $totalIngresos,
            'clientes' => $clientes,
            'empleados' => $empleados,
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

    public function show($id)
{
    $pedido = Pedido::with([
        'detallesLotes',
        'detallesReparaciones',
        'detallesConfecciones'
    ])->findOrFail($id);

    // Guardar la URL previa en la sesión (solo si no está ya configurada)
    if (!session()->has('backUrl')) {
        session(['backUrl' => url()->previous()]);
    }

    return view('pedidos.show', compact('pedido'));
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
            logger($detalle); 
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
public function cambiarEstado($id)
{
    $pedido = Pedido::findOrFail($id);

    // Cambiar el estado
    $nuevoEstado = $pedido->estado === 'Pendiente' ? 'Completado' : 'Pendiente';
    $pedido->estado = $nuevoEstado;
    $pedido->save();

    // Redirigir a la URL previa desde la sesión o a una ruta predeterminada
    return redirect(session()->pull('backUrl', route('pedidos.index')))
        ->with('success', 'Estado del pedido actualizado a: ' . $nuevoEstado);
}


}