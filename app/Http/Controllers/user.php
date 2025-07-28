<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Endereco;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class user extends Controller
{
  public function index()
  {
    $user = Auth::user();
    if ($user == null) {
      return redirect()->route('login');
    }
  }

  public function enviarPermissao(Request $request)
  {
    //$permissao = Auth::where('role_id', $request->role_id)->first();
    //$permissao->role_id = $request->role_id;
    //$permissao->save();
    //return redirect()->route('administrativo.permissoes.usuarios');
  }

  public function verificarEmail(Request $request)
  {

    return view('site.verificarEmail');
  }


}
