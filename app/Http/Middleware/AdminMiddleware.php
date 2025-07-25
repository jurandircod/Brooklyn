<?php

namespace App\Http\Middleware;

use Closure;
use App\Roles;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Verifica se o usuário está autenticado E se é admin
        if (Auth::check() && Auth::user()->role_id == Roles::ADMIN) {
            return $next($request);
        }

        // Redireciona não-admins
        Alert::error('Acesso não autorizado', 'Você não tem permissão para acessar esta página');
        return back();
    }
}