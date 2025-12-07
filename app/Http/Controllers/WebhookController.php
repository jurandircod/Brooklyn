<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;
use App\Models\Pedido;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('🔔 Webhook Mercado Pago recebido', $request->all());

        // Garante que é PIX
        if (!isset($request->type) || $request->type !== 'payment') {
            return response()->json(['status' => 'ignored']);
        }

        $paymentId = $request->data['id'] ?? null;

        if (!$paymentId) {
            return response()->json(['error' => 'Payment ID não enviado'], 400);
        }

        try {
            MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));

            $client = new PaymentClient();
            $payment = $client->get($paymentId);

            Log::info('Dados do pagamento:', (array) $payment);

            // ID do pedido que você colocou lá no createPixPayment
            $pedidoId = $payment->external_reference;

            $pedido = Pedido::find($pedidoId);

            if (!$pedido) {
                Log::error("Pedido não encontrado", ['pedido_id' => $pedidoId]);
                return response()->json(['error' => 'Pedido não encontrado'], 404);
            }

            if ($payment->status === 'approved') {

                $pedido->status = 'pago';
                $pedido->save();

                Log::info("✅ Pedido {$pedidoId} confirmado via PIX!");

                return response()->json(['status' => 'payment approved']);
            }

            $pedido->status = $payment->status;
            $pedido->save();

            return response()->json(['status' => $payment->status]);

        } catch (\Exception $e) {
            Log::error('Erro no webhook Mercado Pago', [
                'message' => $e->getMessage()
            ]);

            return response()->json(['error' => 'Erro interno'], 500);
        }
    }
}
