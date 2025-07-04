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

    public function enviarPermissao(Request $request)
    {
//

  //      $permissao = Auth::where('role_id', $request->role_id)->first();
    //    $permissao->role_id = $request->role_id;
      //  $permissao->save();
        //return redirect()->route('administrativo.permissoes.usuarios');
    }
}
