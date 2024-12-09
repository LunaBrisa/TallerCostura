<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Auditoria as AuditoriaModel;
use Carbon\Carbon;

class AuditoriaController extends Controller
{
    public function index(Request $request)
    {
        // Obtener los filtros del request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $quickFilter = $request->input('quick_filter'); // Nuevo filtro rápido
        $usuario = $request->input('usuario');

        // Construir la consulta base
        $query = AuditoriaModel::query();

        // Aplicar filtro de rango de fechas
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        } elseif ($quickFilter) {
            switch ($quickFilter) {
                case 'today':
                    $query->whereDate('created_at', Carbon::today());
                    break;
                case 'last_7_days':
                    $query->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()]);
                    break;
                case 'last_30_days':
                    $query->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()]);
                    break;
            }
        }

        // Aplicar filtro de usuario responsable
        if ($usuario) {
            $query->where('usuario', 'like', '%' . $usuario . '%');
        }

        // Obtener los resultados ordenados
        $auditorias = $query->orderBy('created_at', 'desc')->get();

        // Retornar la vista con los resultados filtrados
        return view('Auditorias.Auditorias', compact('auditorias'));
    }

    public function showAuditorias()
    {
        $auditorias = AuditoriaModel::orderBy('created_at', 'desc')->get();

        return view('Auditorias.Auditorias', compact('auditorias'));
    }
}
