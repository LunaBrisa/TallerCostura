<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    // Mostrar el formulario de inicio de sesión
    public function create()
    {
        return view('auth.login');
    }
    // Iniciar sesión
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $user = User::where('email', $request->email)->first();

        if ($user && !$user->visible) {
            return redirect()->route('login')->withErrors(['email' => 'Tu cuenta está inactiva. Contacta al administrador.']);
        }


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        throw ValidationException::withMessages([
            'email' => ['Las credenciales no coinciden con nuestros registros.'],
        ]);

        
    }

    // Cerrar sesión
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
