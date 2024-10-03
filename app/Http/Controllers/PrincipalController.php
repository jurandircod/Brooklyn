<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function principal(Request $request){
        if($request->query('cart') == 1){
            $cart = $request->query('cart');
            return view('site.principal')->with(['cart' => $cart]);
        }else{
            $cart = null;
            return view('site.principal')->with(['cart' => $cart]);
        }

        
    }
}
