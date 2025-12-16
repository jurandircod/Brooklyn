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

    /**
     * Cria pagamento com cartão (credit/debit) a partir do card_token gerado no front-end.
     *
     * @param float $amount
     * @param string $description
     * @param string $cardToken  // token gerado pelo MercadoPago.js (card token)
     * @param array $payer      // ['email'=>'','first_name'=>'','last_name'=>'','identification'=>['type'=>'CPF','number'=>'...']]
     * @param int $installments // número de parcelas (1 para débito ou pagamento à vista)
     * @param string|null $payment_method_id // ex: 'visa', 'master' (ideal enviar do front)
     * @param string $payment_type_id // 'credit_card' ou 'debit_card'
     *
     * @return array
     * @throws Exception
     */
    public function createCardPayment(
        float $amount,
        string $description,
        string $cardToken,
        array $payer,
        int $installments = 1,
        ?string $payment_method_id = null,
        string $payment_type_id = 'credit_card'
    ) {
        try {
            if (!$cardToken) {
                throw new Exception('cardToken inválido');
            }

            // Garantir campos mínimos do payer
            $payerEmail = $payer['email'] ?? 'comprador@teste.com';
            $identification = $payer['identification'] ?? ['type' => 'CPF', 'number' => preg_replace('/[^0-9]/','',$payer['cpf'] ?? ($payer['identification']['number'] ?? '00000000000'))];

            $paymentRequest = [
                "transaction_amount" => (float) $amount,
                "token" => $cardToken, // token do front-end
                "description" => substr($description ?? 'Pagamento', 0, 200),
                "installments" => (int) $installments,
                // payment_method_id idealmente obtido no front-end via MercadoPago.getPaymentMethod / cardForm
                "payment_method_id" => $payment_method_id ?? ($payer['payment_method_id'] ?? null),
                // Indica se é cartão de crédito ou débito (credit_card | debit_card)
                "payment_type_id" => $payment_type_id,
                "payer" => [
                    "email" => $payerEmail,
                    "first_name" => $payer['first_name'] ?? ($payer['name'] ?? 'Cliente'),
                    "last_name" => $payer['last_name'] ?? '',
                    "identification" => [
                        "type" => $identification['type'] ?? 'CPF',
                        "number" => preg_replace('/[^0-9]/','',$identification['number'] ?? '00000000000')
                    ]
                ],
                "external_reference" => $payer['pedido_id'] ?? null,
            ];

            Log::info('Enviando pagamento CARTÃO para o Mercado Pago', $paymentRequest);

            $payment = $this->paymentClient->create($paymentRequest);

            if (isset($payment->error)) {
                Log::error('Erro Mercado Pago (cartão)', ['error' => $payment->error]);
                throw new Exception($payment->error->message ?? 'Erro desconhecido no Mercado Pago');
            }

            // Retorno útil para seu frontend/backend
            $response = [
                'id' => $payment->id ?? null,
                'status' => $payment->status ?? null,
                'status_detail' => $payment->status_detail ?? null,
                'amount' => $payment->transaction_amount ?? $amount,
                'installments' => $payment->installments ?? $installments,
                'payment_method_id' => $payment->payment_method_id ?? $payment_method_id,
                'card' => $payment->card ?? null,
                'raw' => $payment // objeto completo, útil para debugar/log
            ];

            Log::info('Pagamento CARTÃO criado com sucesso', ['payment_id' => $response['id']]);

            return $response;
        } catch (Exception $e) {
            Log::error('Erro ao criar pagamento CARTÃO', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            throw new Exception("Erro ao criar pagamento CARTÃO: " . $e->getMessage());
        }
    }

    /**
     * Recupera o pagamento pelo ID (útil para webhooks/consultas)
     */
    public function getPaymentById($paymentId)
    {
        try {
            if (!$paymentId) {
                throw new Exception('paymentId obrigatório');
            }

            $response = $this->paymentClient->get($paymentId);

            return $response;
        } catch (Exception $e) {
            Log::error('Erro ao buscar pagamento', ['message' => $e->getMessage()]);
            throw $e;
        }
    }
}