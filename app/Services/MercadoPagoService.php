<?php

namespace App\Services;

use MercadoPago\SDK;
use MercadoPago\Payment;
use GuzzleHttp\Client;

class MercadoPagoService
{
    public function __construct()
    {
        // 1. Configure o token
        SDK::setAccessToken(config('mercadopago.access_token'));
        // 2. Configuração SSL para ambiente local
    }

    public function createPixPayment($amount, $description, $customer)
    {
        try {
            $payment = new Payment();
            $payment->transaction_amount = $amount;
            $payment->description = $description;
            $payment->payment_method_id = "pix";
            $payment->payer = [
                "email" => $customer['email'],
                "first_name" => $customer['first_name'],
                "last_name" => $customer['last_name'],
                "identification" => [
                    "type" => "CPF",
                    "number" => $customer['cpf']
                ]
            ];

            $payment->save();

            return $payment;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao criar pagamento PIX: " . $e->getMessage());
        }
    }
}
