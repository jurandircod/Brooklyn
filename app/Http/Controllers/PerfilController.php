<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Endereco;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    
    
    public function index()
    {
        return view('site.perfil');
    }

    public function exibirEndereco(){
        $activeTab = 3;
        $user = Auth::user();
        if ($user == null) {
            return redirect()->route('login');
        } else {
            $enderecos = Endereco::where('user_id', Auth::user()->id)->get();
            return view('site.perfil', compact('enderecos', 'activeTab'));
        }
    }
}
