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

    $insumosMasUtilizados = DB::table('DETALLE_INSUMO')
        ->join('INSUMOS', 'DETALLE_INSUMO.insumo_id', '=', 'INSUMOS.id')
        ->select('INSUMOS.insumo', DB::raw('SUM(DETALLE_INSUMO.cantidad_insumo) as total_usado'))
        ->groupBy('INSUMOS.insumo')
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
    public function update(Request $request, $id)
{
    $request->validate([
        'insumo' => 'required|string|max:255',
        'cantidad_reabastecer' => 'nullable|integer|min:0',
        'precio_unitario' => 'nullable|numeric|min:0',
    ]);

    $insumo = Insumo::findOrFail($id);

    // Sumar el stock actual con la cantidad reabastecida
    $insumo->cantidad_stock += $request->input('cantidad_reabastecer');
    $insumo->insumo = $request->input('insumo');
    $insumo->precio_unitario = $request->input('precio_unitario', $insumo->precio_unitario);

    $insumo->save();

    return redirect()->route('inventario.index')->with('success', 'Insumo actualizado correctamente.');
}


}
