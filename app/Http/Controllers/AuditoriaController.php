<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Auditoria as AuditoriaModel;

class AuditoriaController extends Controller
{
    public function index()
    {

            $auditorias = AuditoriaModel::orderBy('created_at', 'desc')->get();
            return view('Auditorias.Auditorias', compact('auditorias'));
        
    }

    public function showAuditorias()
    {
        $auditorias = AuditoriaModel::orderBy('created_at', 'desc')->get();

        return view('Auditorias.Auditorias', compact('auditorias'));
    }
}
