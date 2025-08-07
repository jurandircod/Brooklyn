<?php
// app/Http/Controllers/PaymentController.php

namespace App\Http\Controllers;

use App\Model\User;
use App\Services\MercadoPagoService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $mercadoPago;

    // Injeção do Service
    public function __construct(MercadoPagoService $mercadoPago)
    {
        $this->mercadoPago = $mercadoPago;
    }

    public function createPixPayment(Request $request)
    {
        $validated = $request->validate([
            'valor' => 'required|numeric|min:1', // Valor em reais (ex: 20.50)
            'descricao' => 'required|string|max:255',
            'cpf' => 'required|digits:11' // CPF com 11 dígitos
        ]);

        $user = auth()->user(); // Usuário logado

        $payment = $this->mercadoPago->createPixPayment(
            $validated['valor'], // Converte para centavos
            $validated['descricao'],
            [
                'email' => $user->email,
                'first_name' => explode(' ', $user->name)[0], // Primeiro nome
                'last_name' => explode(' ', $user->name)[1] ?? '', // Sobrenome
                'cpf' => preg_replace('/[^0-9]/', '', $validated['cpf']) // Remove formatação
            ]
        );

        return response()->json([
            'status' => $payment->status,
            'qr_code' => $payment->point_of_interaction->transaction_data->qr_code,
            'qr_code_base64' => $payment->point_of_interaction->transaction_data->qr_code_base64,
            'expiration' => $payment->date_of_expiration
        ]);
    }
}
