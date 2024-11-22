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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'nombre' => 'required||min:3|max:50',
            'apellido_p' => 'required||min:3|max:50',
            'apellido_m' => 'required||max:255',
            'telefono' => 'required|digits:10',
            'compania' => 'required||min:5|max:50',
            'cargo' => 'max:50',
        ]);

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
