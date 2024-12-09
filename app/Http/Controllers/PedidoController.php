<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\Empleado;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Servicio;
use App\Models\DetalleReparacion;
use App\Models\ReparacionServicio;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\PrendaConfeccion;
use App\Models\Medida;
use App\Models\DetalleInsumo;
use App\Models\PrendaTela;
use App\Models\PrendasColores;
use App\Models\DetalleConfeccion;
use App\Models\Insumo;
use App\Models\PrendaColor;
use App\Models\Tela;

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
    {// Validación de fechas en el controlador
        $request->validate([
            'fecha_inicio' => 'nullable|date',  // fecha_inicio es opcional pero debe ser una fecha válida si está presente
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio', // fecha_fin es opcional y solo se valida si fecha_inicio está presente
        ], [
            'fecha_inicio.before_or_equal' => 'La fecha de inicio no puede ser posterior a la fecha de fin.',
            'fecha_fin.after_or_equal' => 'La fecha de fin no puede ser anterior a la fecha de inicio.',
        ]);

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
        // Filtro por fecha
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $fechaInicio = $request->fecha_inicio;
            $fechaFin = $request->fecha_fin;
            $query->whereBetween('fecha_pedido', [$fechaInicio, $fechaFin]);
        } elseif ($request->filled('fecha_inicio')) {
            $fechaInicio = $request->fecha_inicio;
            $query->where('fecha_pedido', '>=', $fechaInicio);
        } elseif ($request->filled('fecha_fin')) {
            $fechaFin = $request->fecha_fin;
            $query->where('fecha_pedido', '<=', $fechaFin);
        }
        // Filtro por estado
        if ($request->filled('estado')) {
            $estado = strtolower($request->estado);
            $query->where('estado', ucfirst($estado));
        }
        $servicios = Servicio::select('id', 'servicio', 'descripcion', 'precio')
        ->get();

        $pedidos = $query->with(['cliente', 'empleado'])->get();
        $estadisticas = $this->obtenerEstadisticas();

        return view('pedidos.index', compact('pedidos', 'estadisticas', 'servicios'));
    }

    public function show($id)
{
    $pedido = Pedido::with([
        'detallesLotes',
        'detallesReparaciones.servicios',
        'detallesConfecciones.prendaConfeccion.prendasColor.color', // Relación de colores
        'detallesConfecciones.prendaConfeccion.prendasTelas.tela.materialTela',   // Relación de telas
        'detallesConfecciones.medidas'                              // Relación de medidas
    ])->findOrFail($id);

    // Guardar la URL previa en la sesión (solo si no está ya configurada)
    if (!session()->has('backUrl')) {
        session(['backUrl' => url()->previous()]);
    }

    return view('pedidos.show', compact('pedido'));
}
public function store(Request $request)
{
    // Reindexar arrays para evitar problemas de índices no consecutivos
    $detallesLote = $request->has('detalles_lote') ? $request->input('detalles_lote') : [];
$detallesReparaciones = $request->has('detalles_reparaciones') ? $request->input('detalles_reparaciones') : [];

    // Validar los datos del formulario
    $request->validate([
        'cliente' => 'required|exists:CLIENTES,id',
        'empleado' => 'required|exists:EMPLEADOS,id',
        'fecha_pedido' => 'required|date|after_or_equal:today',
        'fecha_entrega' => 'required|date|after_or_equal:fecha_pedido',
        'descripcion' => 'required|string',
        'detalles_lote' => 'nullable|array',
        'detalles_lote.*.prenda' => 'required|string',
        'detalles_lote.*.precio_por_prenda' => 'required|numeric|min:0',
        'detalles_lote.*.cantidad' => 'required|integer|min:1',
        'detalles_lote.*.anticipo' => 'required|numeric|min:0',
        'detalles_reparaciones' => 'nullable|array',
        'detalles_reparaciones.*.prenda' => 'required|string|max:100',
        'detalles_reparaciones.*.cantidad' => 'required|integer|min:1',
        'detalles_reparaciones.*.descripcion_problema' => 'nullable|string|max:500',
        'detalles_reparaciones.*.servicio' => 'required|exists:SERVICIOS,id',
    ],[
        'fecha_pedido.after_or_equal' => 'La fecha de pedido no puede ser en el pasado.',
        'fecha_entrega.after_or_equal' => 'La fecha de entrega debe ser igual o posterior a la fecha de pedido.',
    ]);

    // Crear el pedido principal
    $pedido = Pedido::create([
        'cliente_id' => $request->cliente,
        'empleado_id' => $request->empleado,
        'fecha_pedido' => $request->fecha_pedido,
        'fecha_entrega' => $request->fecha_entrega,
        'descripcion' => $request->descripcion,
        'estado' => 'Pendiente',
    ]);

    // Procesar detalles de lotes
    foreach ($detallesLote as $detalle) {
        if (!empty($detalle['prenda']) && isset($detalle['precio_por_prenda'], $detalle['cantidad'], $detalle['anticipo'])) {
            $pedido->detallesLotes()->create([
                'prenda' => $detalle['prenda'],
                'precio_por_prenda' => $detalle['precio_por_prenda'],
                'cantidad' => $detalle['cantidad'],
                'anticipo' => $detalle['anticipo'],
            ]);
        }
    }

    // Procesar detalles de reparaciones
    foreach ($detallesReparaciones as $detalle) {
        if (!empty($detalle['prenda']) && isset($detalle['cantidad'], $detalle['servicio'])) {
            $detalleReparacion = DetalleReparacion::create([
                'pedido_id' => $pedido->id,
                'prenda' => $detalle['prenda'],
                'descripcion_problema' => $detalle['descripcion_problema'] ?? null,
                'cantidad_prenda' => $detalle['cantidad'],
            ]);
            // Asociar el servicio al detalle de reparación
            try {
                ReparacionServicio::create([
                    'detalle_reparacion_id' => $detalleReparacion->id,
                    'servicio_id' => $detalle['servicio'],
                ]);
                
                
            } catch (\Exception $e) {
                Log::error('Error al asociar servicio con detalle_reparacion: ' . $e->getMessage());
                dd($e);  // Para ver el error completo
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

public function verprendas()
{
    $prendas = PrendaConfeccion::all();
    return view('pedidos.index', compact('prendas'));
}


public function CrearPedido(Request $request)
{
    DB::beginTransaction();

    try {
        // Crear el pedido
        $pedido = Pedido::create([
            'empleado_id' => $request->empleado,
            'cliente_id' => $request->cliente,
            'fecha_pedido' => $request->fecha_pedido,
            'fecha_entrega' => $request->fecha_entrega,
            'descripcion' => $request->descripcion, // Actualizaremos luego con el subtotal
        ]);

        // Procesar detalles de confecciones
        foreach ($request->detalles_confecciones as $detalle) {
            $detalleConfeccion = DetalleConfeccion::create([
                'pedido_id' => $pedido->id,
                'prenda_confeccion_id' => $detalle['prenda_confeccion'],
                'cantidad_prenda' => $detalle['cantidad_prenda'],
            ]);

            // Guardar medidas
            if (!empty($detalle['medidas'])) {
                Medida::create([
                    'detalle_confeccion_id' => $detalleConfeccion->id,
                    'pecho' => $detalle['medidas']['pecho'],
                    'cintura' => $detalle['medidas']['cintura'],
                    'mangas' => $detalle['medidas']['mangas'],
                    'largo' => $detalle['medidas']['largo'],
                ]);
            }
            // Guardar insumos asociados
            if (!empty($detalle['insumos'])) {
                foreach ($detalle['insumos'] as $insumo) {
                    DetalleInsumo::create([
                        'detalle_confeccion_id' => $detalleConfeccion->id,
                        'insumo_id' => $insumo['id'],
                        'cantidad_insumo' => $insumo['cantidad_insumo'],
                    ]);
                }
            }
        }

        DB::commit();
        return redirect()->route('pedidos.index')->with('success', 'Pedido creado exitosamente.');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->withErrors('Error al crear el pedido: ' . $e->getMessage());
    }
}

public function pedidoconfeccion()
{
    $prendas = PrendaColor::whereHas('prenda', function ($query) {
        $query->where('visible', true);
    })->with('prenda', 'color')->get();

    $telas = Tela::all();
    $insumos = Insumo::all();
    $clientes = Cliente::all();
    $empleados = Empleado::all();
    return view('pedidos.pedidoconfeccion', compact('prendas', 'telas', 'insumos', 'clientes', 'empleados', 'prendas'));
}

}
