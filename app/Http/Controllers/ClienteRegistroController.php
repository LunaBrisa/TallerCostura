<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ClienteRegistroController extends Controller
{
    public function RegistrarCliente(Request $request): RedirectResponse
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
        $compania = $request->input('compania');
        $cargo = $request->input('cargo');

        try {
            DB::statement('CALL crear_cliente(?, ?, ?, ?, ?, ?, ?)', [
                $user_id,
                $nombre,
                $apellido_p,
                $apellido_m,
                $telefono,
                $compania,
                $cargo,
            ]);

            return redirect()->back()->with('success', 'Cliente creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el cliente: ' . $e->getMessage());
        }
    }
}
