<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Roles;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class FornecedorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role_id == Roles::FORNECEDOR) {
            return $next($request);
        }

        // Redireciona não-admins
        Alert::error('Acesso não autorizado', 'Você não tem permissão para acessar esta página');
        return back();
    }
}
