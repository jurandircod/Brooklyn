<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop(Request $request)
    {
        return view('site.shop');
    }
}
