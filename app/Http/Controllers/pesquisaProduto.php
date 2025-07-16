<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pesquisaProduto extends Controller
{
    public function index()
    {
        return view('site.shop');
    }
}
