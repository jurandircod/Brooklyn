<?php

namespace App\Services;

use MercadoPago\SDK;
use MercadoPago\Payment;
use Exception;
use Illuminate\Support\Facades\Log;

class MercadoPagoService
{
    public function __construct()
    {
        $accessToken = env('MERCADO_PAGO_ACCESS_TOKEN');

        if (!$accessToken) {
            throw new Exception('MERCADO_PAGO_ACCESS_TOKEN não configurado no .env');
        }

        SDK::setAccessToken($accessToken);
    }

    public function createPixPayment($amount, $description, $customer)
    {
        try {
            // Validação básica
            if (!is_array($customer)) {
                throw new Exception('Parâmetro customer deve ser um array');
            }

            $payment = new Payment();

            // O valor deve ser FLOAT (em reais), não centavos
            $payment->transaction_amount = (float) $amount;
            $payment->description = substr($description ?? 'Pagamento', 0, 200);
            $payment->payment_method_id = "pix";

            // Dados do pagador (use dados reais se disponíveis)
            $cpf = isset($customer['cpf']) ? preg_replace('/[^0-9]/', '', $customer['cpf']) : '12345678900';
            $payment->payer = [
                "email" => $customer['email'] ?? 'comprador@teste.com',
                "first_name" => $customer['first_name'] ?? 'Cliente',
                "last_name" => $customer['last_name'] ?? 'Teste',
                "identification" => [
                    "type" => "CPF",
                    "number" => $cpf
                ]
            ];

            Log::info('Enviando pagamento PIX para o Mercado Pago', [
                'amount' => $amount,
                'description' => $description,
                'payer' => $payment->payer
            ]);

            // Salva o pagamento (gera o QR Code)
            $payment->save();

            if (isset($payment->error)) {
                Log::error('=== ERRO DETALHADO MERCADO PAGO ===', [
                    'status' => $payment->error->status ?? null,
                    'code' => $payment->error->cause[0]->code ?? null,
                    'description' => $payment->error->cause[0]->description ?? null,
                    'message' => $payment->error->message ?? null,
                    'full_error' => $payment->error // salva tudo pra garantir
                ]);

                throw new Exception($payment->error->message ?? 'Erro desconhecido no Mercado Pago');
            }
            // Verificação de erro da API
            if (isset($payment->error)) {
                Log::error('Erro Mercado Pago PIX:', (array) $payment->error);
                throw new Exception($payment->error->message ?? 'Erro desconhecido do Mercado Pago');
            }

            if (!$payment->id) {
                throw new Exception('Pagamento não criado: ID ausente.');
            }

            // Retorna os dados do QR PIX
            $pixData = [
                'id' => $payment->id,
                'status' => $payment->status ?? 'unknown',
                'amount' => $payment->transaction_amount,
                'description' => $payment->description ?? '',
                'pix_copia_cola' => $payment->point_of_interaction->transaction_data->qr_code ?? null,
                'qr_code_base64' => $payment->point_of_interaction->transaction_data->qr_code_base64 ?? null,
                'ticket_url' => $payment->point_of_interaction->transaction_data->ticket_url ?? null
            ];

            Log::info('PIX criado com sucesso', ['pix_id' => $pixData['id']]);

            return $pixData;
        } catch (Exception $e) {
            Log::error('Erro ao criar pagamento PIX', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            throw new Exception("Erro ao criar pagamento PIX: " . $e->getMessage());
        }
    }
}
