<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\Empleado;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Servicio;
use App\Models\DetalleReparacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\PrendaConfeccion;
use App\Models\Medida;
use App\Models\DetalleInsumo;
use App\Models\PrendaTela;
use App\Models\DetalleConfeccion;
use App\Models\Insumo;
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
        $servicios = Servicio::select('id', 'servicio', 'descripcion', 'precio')
        ->get();

        $pedidos = $query->with(['cliente', 'empleado'])->get();
        $estadisticas = $this->obtenerEstadisticas();

        $prendas = PrendaConfeccion::all();
        $telas = Tela::all(); 
    $insumos = Insumo::all();
        return view('pedidos.index', compact('pedidos', 'estadisticas', 'servicios', 'prendas', 'telas', 'insumos'));
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
        'fecha_pedido' => 'required|date',
        'fecha_entrega' => 'required|date',
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
                $detalleReparacion->servicios()->syncWithoutDetaching([$detalle['servicio']]);

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

public function CrearPedidoConfeccion(Request $request){
    $pedido = new Pedido;
    $pedido->cliente_id = $request->cliente;
    $pedido->empleado_id = $request->empleado;
    $pedido->fecha_pedido = $request->fecha_pedido;
    $pedido->fecha_entrega = $request->fecha_entrega;
    $pedido->descripcion = $request->descripcion;
    $pedido->save();
    
    $detalleConfeccion = new DetalleConfeccion;
    $detalleConfeccion->pedido_id = $pedido->id;
    $detalleConfeccion->prenda_confeccion_id = $request->prenda_confeccion;
    $detalleConfeccion->cantidad = $request->cantidad;
    $detalleConfeccion->save();

    $medidas = new Medida;
    $medidas->detalle_confeccion_id = $detalleConfeccion->id;
    $medidas->pecho = $request->pecho;
    $medidas->cintura = $request->cintura;
    $medidas->mangas = $request->mangas;
    $medidas->largo = $request->largo;
    $medidas->save();

    $detalleInsumos = new DetalleInsumos;
    $detalleInsumos->pedido_id = $pedido->id;
    $detalleInsumos->insumo_id = $request->insumo;
    $detalleInsumos->cantidad_insumo = $request->cantidad_insumo;
    $detalleInsumos->save();

    $prendasTelas = new PrendaTela;
    $prendasTelas->prenda_confeccion_id = $request->prenda_confeccion;
    $prendasTelas->tela_id = $request->tela;
    $prendasTelas->cantidad_tela = $request->cantidad_tela;
    $prendasTelas->save();


  return redirect()->route('pedidos.index')->with('success', 'Pedido creado exitosamente.');
}

}