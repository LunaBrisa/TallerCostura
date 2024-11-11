<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use App\Models\Servicio;
use Illuminate\Support\Facades\DB;

class ClienteRegistroController extends Controller
{
    public function RegistrarCliente(Request $request): RedirectResponse
    {
        $nombre_usuario = $request->input('nombre_usuario');
        $contrasena = $request->input('contrasena');
        $rol_nombre = $request->input('rol_nombre');

        try {
            DB::statement('CALL crear_usuario(?, ?, ?)', [
                $nombre_usuario,
                $contrasena,
                $rol_nombre
            ]);

            return redirect()->back()->with('success', 'Usuario creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el usuario: ' . $e->getMessage());
        }
    }

    public function MostrarServicios()
    {

    }
}
