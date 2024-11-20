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
        $totalIngresos = Pedido::where('estado', 'Completado')->sum('total');

        // Consultas adicionales
        $pedidosPorCliente = Pedido::select('cliente_id', DB::raw('count(*) as cantidad_pedidos'))
            ->groupBy('cliente_id')
            ->orderBy('cantidad_pedidos', 'desc') 
            ->limit(3)
            ->get();

        $pedidosPorEmpleado = Pedido::with('empleado')->select('empleado_id', DB::raw('count(*) as cantidad_pedidos'))
            ->groupBy('empleado_id')
            ->orderBy('cantidad_pedidos', 'desc') 
            ->limit(3)
            ->get();

        // Recoger otros datos necesarios
        $clientes = Cliente::all();
        $empleados = Empleado::all();

        // Devolver un array con las variables necesarias para la vista
        return [
            'totalPedidos' => $totalPedidos, 
            'pedidosEnProceso' => $pedidosEnProceso, 
            'pedidosCompletados' => $pedidosCompletados, 
            'totalIngresos' => $totalIngresos,
            'totalEnProceso' => $totalEnProceso,
            'totalPedidos' => $totalPedidos,
            'pedidosPorCliente' => $pedidosPorCliente, 
            'pedidosPorEmpleado' => $pedidosPorEmpleado, 
            'clientes' => $clientes,
            'empleados' => $empleados
        ];
    }
    public function index(Request $request)
    {
        $query = Pedido::query();
// Filtrar por ID de orden si se ha proporcionado
if ($request->has('orden') && $request->orden) {
    $orden = $request->orden;
    $query->where('id', 'like', '%' . $orden . '%'); // Búsqueda por ID de orden
}

// Filtrar por nombre de cliente si se ha proporcionado
if ($request->has('cliente') && $request->cliente) {
    $cliente = $request->cliente;
    $query->whereHas('cliente', function ($query) use ($cliente) {
        $query->whereHas('persona', function ($query) use ($cliente) {
            $query->where('nombre', 'like', '%' . $cliente . '%'); // Búsqueda por nombre del cliente
        });
    });
}
        // Aplicar filtro si 'estado' está presente en la solicitud
        if ($request->has('estado')) {
            $estado = $request->estado;
            if ($estado == 'Completado') {
                $query->where('estado', 'Completado');
            } elseif ($estado == 'Pendiente') {
                $query->where('estado', 'Pendiente');
            }
        }
    
        $pedidos = $query->with('cliente', 'empleado')->get();
        // Llamar al método auxiliar para obtener las variables necesarias
        $estadisticas = $this->obtenerEstadisticas();

        // Pasar los pedidos y las estadísticas a la vista
        return view('pedidos.index', compact('pedidos', 'estadisticas'));
    }
public function show($id)
    {
        $pedido = Pedido::with([
            'cliente',
            'empleado',
            'detallesConfeccion.PrendaConfeccion', 
            'detallesLote', 
            'detallesReparacion.prendaReparacion.servicio',
        ])->findOrFail($id); 
        return view('pedidos.show', compact('pedido'));
    }
    public function store(Request $request)
    {
        // Validar la entrada del formulario
    $validated = $request->validate([
        'cliente' => 'required|exists:clientes,id',
        'empleado' => 'required|exists:empleados,id',
        'fecha_pedido' => 'required|date',
        'fecha_entrega' => 'required|date',
        'descripcion' => 'required|string',
        'detalles_confeccion' => 'array|nullable',
        'detalles_lote' => 'array|nullable',
        'detalles_reparacion' => 'array|nullable',
    ]);
        // Handle the form data here and create a new order
        $pedido = new Pedido();
        $pedido->cliente_id = $request->cliente;
        $pedido->empleado_id = $request->empleado;
        $pedido->fecha_pedido = $request->fecha_pedido;
        $pedido->fecha_entrega = $request->fecha_entrega;
        $pedido->descripcion = $request->descripcion;
        // Add logic to save the order
        $pedido->save();
// 2. Guardar los detalles de confección (si existen)
if ($request->has('detalles_confeccion')) {
    foreach ($request->detalles_confeccion as $detalle) {
        $pedido->detallesConfeccion()->create([
            'prenda_id' => $detalle['prenda_id'],
            'cantidad' => $detalle['cantidad'],
            // Agrega más campos aquí según sea necesario
        ]);
    }
}

// 3. Guardar los detalles de lote (si existen)
if ($request->has('detalles_lote')) {
    foreach ($request->detalles_lote as $detalle) {
        $pedido->detallesLote()->create([
            'prenda' => $detalle['prenda'],
            'precio_por_prenda' => $detalle['precio_por_prenda'],
            'cantidad' => $detalle['cantidad'],
            'anticipo' => $detalle['anticipo'],
            'subtotal' => $detalle['subtotal'],
        ]);
    }
}

// 4. Guardar los detalles de reparación (si existen)
if ($request->has('detalles_reparacion')) {
    foreach ($request->detalles_reparacion as $detalle) {
        $pedido->detallesReparacion()->create([
            'prenda_reparacion_id' => $detalle['prenda_reparacion_id'],
            'servicio_id' => $detalle['servicio_id'],
            'cantidad_prenda' => $detalle['cantidad_prenda'],
            'subtotal' => $detalle['subtotal'],
            // Agrega más campos aquí según sea necesario
        ]);
    }
}
        // Llamar al método auxiliar para obtener las estadísticas actualizadas
        $estadisticas = $this->obtenerEstadisticas();

        // Obtener pedidos (si es necesario)
        $pedidos = Pedido::with('cliente', 'empleado')->get();

        // Pasar los pedidos y las estadísticas a la vista
        return view('pedidos.index', compact('pedidos', 'estadisticas'));
    }
}
    