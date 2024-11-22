<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;  // Importar Auth

class ClienteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
           // Verificamos si el usuario tiene el rol "Cliente"
           if (auth()->user()->hasRole('Cliente')) {
            return $next($request);
           }
        // Redirigir si no tiene acceso
        return redirect('/')->with('error', 'Acceso denegado: Solo clientes pueden acceder.');
    }
}