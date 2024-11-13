<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use App\Models\Servicio;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\saveClientesRequest;

class ClienteRegistroController extends Controller
{
    public function RegistrarCliente(saveClientesRequest $request): RedirectResponse
    {
        $nombre_usuario = $request->input('nombre_usuario');
        $contrasena = $request->input('contrasena');
        $nombre = $request->input('nombre');
        $apellido_p = $request->input('apellido_p');
        $apellido_m = $request->input('apellido_m');
        $telefono = $request->input('telefono');
        $correo = $request->input('correo');
        $compania = $request->input('compania');
        $cargo = $request->input('cargo');

        try {
            DB::statement('CALL crear_cliente(?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $nombre_usuario,
                $contrasena,
                $nombre,
                $apellido_p,
                $apellido_m,
                $telefono,
                $correo,
                $compania,
                $cargo
            ]);

            return redirect()->back()->with('success', 'Cliente creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el cliente: ' . $e->getMessage());
        }
    }

    public function MostrarServicios()
    {

    }
}
