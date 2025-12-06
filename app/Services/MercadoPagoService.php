<?php

namespace App\Services;

// Para versão mais recente (SDK 3.x)
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Common\RequestOptions;
use Exception;
use Illuminate\Support\Facades\Log;

class MercadoPagoService
{
    protected $paymentClient;

    public function __construct()
    {
        $accessToken = env('MERCADOPAGO_ACCESS_TOKEN');

        if (!$accessToken) {
            throw new Exception('MERCADOPAGO_ACCESS_TOKEN não configurado no .env');
        }

        // Configuração para SDK 3.x
        MercadoPagoConfig::setAccessToken($accessToken);
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);
        
        $this->paymentClient = new PaymentClient();
    }

    public function createPixPayment($amount, $description, $customer)
    {
        try {
            if (!is_array($customer)) {
                throw new Exception('Parâmetro customer deve ser um array');
            }

            // Formatar CPF
            $cpf = isset($customer['cpf']) ? preg_replace('/[^0-9]/', '', $customer['cpf']) : '12345678900';
            
            // Montar request para SDK 3.x
            $paymentRequest = [
                "transaction_amount" => (float) $amount,
                "description" => substr($description ?? 'Pagamento', 0, 200),
                "payment_method_id" => "pix",
                "payer" => [
                    "email" => $customer['email'] ?? 'comprador@teste.com',
                    "first_name" => $customer['first_name'] ?? 'Cliente',
                    "last_name" => $customer['last_name'] ?? 'Teste',
                    "identification" => [
                        "type" => "CPF",
                        "number" => $cpf
                    ]
                ],
                "external_reference" => $customer['pedido_id'] ?? null,
            ];

            Log::info('Enviando pagamento PIX para o Mercado Pago', $paymentRequest);

            // Criar pagamento
            $payment = $this->paymentClient->create($paymentRequest);

            if (isset($payment->error)) {
                Log::error('=== ERRO DETALHADO MERCADO PAGO ===', [
                    'error' => $payment->error
                ]);
                throw new Exception($payment->error->message ?? 'Erro desconhecido no Mercado Pago');
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