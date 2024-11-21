<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventarioController extends Controller
{
    public function index(Request $request)
    {
        $insumosMenosStock = Insumo::orderBy('cantidad_stock', 'asc')
    ->limit(3)
    ->get();

    $insumosMasUtilizados = DB::table('detalle_insumo')
        ->join('insumos', 'detalle_insumo.insumo_id', '=', 'insumos.id')
        ->select('insumos.insumo', DB::raw('SUM(detalle_insumo.cantidad_insumo) as total_usado'))
        ->groupBy('insumos.insumo')
        ->orderBy('total_usado', 'desc')
        ->limit(3)
        ->get();



        $query = Insumo::query();
        // Filtrar por Nombre si se ha proporcionado
        if ($request->has('insumo')) {
            $insumo = $request->insumo;
            $query->where('insumo', 'like', '%' . $insumo . '%'); // Búsqueda por Nombre
        }
        if ($request->has('estado')) {
            $estado = $request->estado;
        }
        $insumos = $query->get();
        return view('inventario.index', compact('insumos', 'insumosMenosStock', 'insumosMasUtilizados'));
    }
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'insumo' => 'required|string|max:100',
            'cantidad_stock' => 'required|integer',
            'precio_unitario' => 'required|numeric',
        ]);
    
        
        Insumo::create([
            'insumo' => $request->insumo,
            'cantidad_stock' => $request->cantidad_stock,
            'precio_unitario' => $request->precio_unitario,
        ]);
        return redirect()->route('inventario.index')->with('success', 'Cliente y usuario agregado exitosamente con rol de Cliente.');
    }
}
