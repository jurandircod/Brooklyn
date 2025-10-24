<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MercadoPagoController extends Controller
{
    public function webhook(Request $request)
    {
        Log::info('Webhook Mercado Pago:', $request->all());

        dd(  $request->all());
        // Confirma recebimento com status 200
        return response()->json(['status' => 'received'], 200);
    }
}
