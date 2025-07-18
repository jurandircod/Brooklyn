<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TabelasControllers extends Controller
{
    public function index()
    {
        return view('administrativo.tabelas');
    }
}
