<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Model\Pedido;
use MercadoPago\SDK;
use MercadoPago\Payment;
class WebhookController extends Controller
{
    public function __construct()
    {
        // Configurar SDK do Mercado Pago
        SDK::setAccessToken(config('services.mercadopago.access_token'));
    }

    /**
     * Recebe as notificações do Mercado Pago
     */
    public function handleMercadoPago(Request $request)
    {
        try {
            // Log da requisição recebida
            Log::info('Webhook Mercado Pago recebido', [
                'body' => $request->all(),
                'headers' => $request->headers->all()
            ]);

            // Validar se é uma notificação válida
            $type = $request->input('type');
            $data = $request->input('data');

            if (!$type || !$data) {
                Log::warning('Webhook inválido - dados incompletos');
                return response()->json(['status' => 'error', 'message' => 'Invalid data'], 400);
            }

            // Processar apenas notificações de pagamento
            if ($type === 'payment') {
                $paymentId = $data['id'] ?? null;

                if ($paymentId) {
                    $this->processarPagamento($paymentId);
                }
            }

            // Retornar 200 OK para o Mercado Pago
            return response()->json(['status' => 'success'], 200);

        } catch (\Exception $e) {
            Log::error('Erro ao processar webhook', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json(['status' => 'error'], 500);
        }
    }

    /**
     * Processa o pagamento recebido
     */
    private function processarPagamento($paymentId)
    {
        try {
            // Buscar informações do pagamento no Mercado Pago
            $payment = Payment::find_by_id($paymentId);

            Log::info('Pagamento encontrado', [
                'id' => $payment->id,
                'status' => $payment->status,
                'status_detail' => $payment->status_detail,
                'external_reference' => $payment->external_reference
            ]);

            // Buscar o pedido pelo external_reference
            $pedido = Pedido::where('codigo_rastreio', $payment->external_reference)
                ->orWhere('id', $payment->external_reference)
                ->first();

            if (!$pedido) {
                Log::warning('Pedido não encontrado', [
                    'external_reference' => $payment->external_reference
                ]);
                return;
            }

            // Atualizar status do pedido baseado no status do pagamento
            $this->atualizarStatusPedido($pedido, $payment);

        } catch (\Exception $e) {
            Log::error('Erro ao processar pagamento', [
                'payment_id' => $paymentId,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Atualiza o status do pedido baseado no status do pagamento
     */
    private function atualizarStatusPedido($pedido, $payment)
    {
        $statusAnterior = $pedido->status_pagamento;

        switch ($payment->status) {
            case 'approved':
                $pedido->status_pagamento = 'pago';
                $pedido->data_pagamento = now();
                $pedido->metodo_pagamento = 'pix';
                break;

            case 'pending':
                $pedido->status_pagamento = 'pendente';
                break;

            case 'in_process':
                $pedido->status_pagamento = 'processando';
                break;

            case 'rejected':
                $pedido->status_pagamento = 'rejeitado';
                break;

            case 'cancelled':
                $pedido->status_pagamento = 'cancelado';
                break;

            case 'refunded':
                $pedido->status_pagamento = 'reembolsado';
                break;

            default:
                Log::warning('Status desconhecido', [
                    'status' => $payment->status
                ]);
                return;
        }

        // Salvar informações adicionais
        $pedido->mercadopago_payment_id = $payment->id;
        $pedido->mercadopago_status_detail = $payment->status_detail;
        $pedido->save();

        Log::info('Status do pedido atualizado', [
            'pedido_id' => $pedido->id,
            'status_anterior' => $statusAnterior,
            'status_novo' => $pedido->status_pagamento,
            'payment_id' => $payment->id
        ]);

        // Disparar eventos ou enviar emails
        if ($pedido->status_pagamento === 'pago') {
            // Enviar email de confirmação
            // event(new PedidoPagoEvent($pedido));
            
            // Limpar carrinho do usuário
            // $this->limparCarrinho($pedido->user_id);
        }
    }
}