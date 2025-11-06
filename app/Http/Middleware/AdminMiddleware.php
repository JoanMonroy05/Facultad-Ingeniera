<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica si el usuario tiene el rol 'admin'
        if (auth()->check() && auth()->user()->hasRole('admin')) {
            return $next($request);
        }

        // Si no es admin, redirige o retorna 403
        abort(403, 'Acceso no autorizado.');
    }
}