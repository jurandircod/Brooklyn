<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Endereco;

class PerfilController extends Controller
{
    public function exibirEndereco(Request $request)
    {
        $cep = $request->cep;
        $endereco = Endereco::where('cep', $cep)->first();
        return view('site.perfil.exibirEndereco', compact('endereco'));
    }
    
    public function index()
    {
        return view('site.perfil');
    }
}
