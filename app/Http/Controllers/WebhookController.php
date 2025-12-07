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
        if (
            (!isset($request->type) || $request->type !== 'payment')
            && (!isset($request->action) || !str_contains($request->action, 'payment'))
        ) {
            return response()->json(['status' => 'ignored']);
        }

        $paymentId = $request->input('data.id') ?? $request->id ?? null;

        if (!$paymentId) {
            Log::error('Webhook recebido sem ID de pagamento');
            return response()->json(['error' => 'ID do pagamento não encontrado'], 400);
        }

        try {
            MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));

            $client = new PaymentClient();
            $payment = $client->get($paymentId);

            Log::info('Dados do pagamento:', (array) $payment);

            // ID do pedido que você colocou lá no createPixPayment
            $pedidoId = $payment->external_reference;

            $pedido = Pedido::findOrFail($pedidoId);

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

            Log::warning("⚠️ ID inválido recebido no webhook: {$paymentId}");
            return response()->json([
                'status' => 'ok',
                'warning' => 'ID de teste inválido, mas webhook funcionando'
            ]);
        }
    }
}
