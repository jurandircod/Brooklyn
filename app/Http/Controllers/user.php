<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\{Endereco};
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class User extends Controller
{
  public function index()
  {
    $user = Auth::user();
    if ($user == null) {
      return redirect()->route('login');
    }
  }

  public function verificarEmail(Request $request)
  {

    return view('site.verificarEmail');
  }
}
