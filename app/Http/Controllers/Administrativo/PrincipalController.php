<?php

namespace App\Http\Controllers\Administrativo;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function index()
    {
        return view('administrativo.principal');
    }
}
