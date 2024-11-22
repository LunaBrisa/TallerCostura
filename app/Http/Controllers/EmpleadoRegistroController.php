<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EmpleadoRegistroController extends Controller
{
    public function RegistrarEmpleado(Request $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        // Obtener el ID del usuario recién creado
        $user_id = $user->id;

        $nombre = $request->input('nombre');
        $apellido_p = $request->input('apellido_p');
        $apellido_m = $request->input('apellido_m');
        $telefono = $request->input('telefono');
        $fecha_nacimiento = $request->input('fecha_nacimiento');
        $rfc = $request->input('rfc');
        $nss = $request->input('nss');

        try {
            DB::statement('CALL crear_empleado(?, ?, ?, ?, ?, ?, ?, ?)', [
                $user_id,
                $nombre,
                $apellido_p,
                $apellido_m,
                $telefono,
                $fecha_nacimiento,
                $rfc,
                $nss,
            ]);

            return redirect()->back()->with('success', 'Empleado creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el empleado: ' . $e->getMessage());
        }
    }
}
