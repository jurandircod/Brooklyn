<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Endereco;
use Illuminate\Support\Facades\Auth;

class user extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user == null) {
            return redirect()->route('login');
        } else {
            $enderecosMostrar = Endereco::where('user_id', Auth::user()->id)->get();
            return view('site.perfil', compact('enderecosMostrar'));
        }
    }
}
