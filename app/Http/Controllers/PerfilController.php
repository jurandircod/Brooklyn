<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Endereco;
use App\Pedido;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{


    public function index()
    {
        
        $enderecosMostrar = Endereco::where('user_id', Auth::user()->id)->get();
        $pedidos = Pedido::where('user_id', Auth::user()->id)->get();
        return view('site.perfil', compact('enderecosMostrar', 'pedidos'));
    }

    public function exibirEndereco()
    {
        
        $activeTab = 3;

        $pedidos = Pedido::where('user_id', Auth::user()->id)->get();
        $user = Auth::user();
        if ($user == null) {
            return redirect()->route('login');
        } else {
            $enderecos = Endereco::where('user_id', Auth::user()->id)->get();
            return view('site.perfil', compact('enderecos', 'activeTab', 'pedidos', 'pedidosContador'));
        }
    }
}
