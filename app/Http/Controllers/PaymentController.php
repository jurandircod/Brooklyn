<?php
// app/Http/Controllers/PaymentController.php

namespace App\Http\Controllers;

use App\Model\User;
use App\Services\MercadoPagoService;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image; // <- certifique-se de ter instalado intervention/image

class PaymentController extends Controller
{
    protected $mercadoPago;

    public function __construct(MercadoPagoService $mercadoPago)
    {
        $this->mercadoPago = $mercadoPago;
    }

    public function createPixPayment(Request $request)
    {
        $validated = $request->validate([
            'valor' => 'required|numeric|min:1',
            'descricao' => 'required|string|max:255',
            'cpf' => 'required|digits:11'
        ]);

        $user = auth()->user();

        $payment = $this->mercadoPago->createPixPayment(
            $validated['valor'],
            $validated['descricao'],
            [
                'email' => $user->email,
                'first_name' => explode(' ', $user->name)[0],
                'last_name' => explode(' ', $user->name)[1] ?? '',
                'cpf' => preg_replace('/[^0-9]/', '', $validated['cpf'])
            ]
        );

        // Pega os dados retornados pelo MP
        $rawQr = $payment->point_of_interaction->transaction_data->qr_code ?? null;
        $rawQrBase64 = $payment->point_of_interaction->transaction_data->qr_code_base64 ?? null;

        // Se houver base64 da imagem, redimensiona antes de retornar
        $smallBase64 = null;
        if ($rawQrBase64) {
            // Pode vir como "data:image/png;base64,...." ou somente o corpo base64
            if (preg_match('/^data:image\/[a-zA-Z]+;base64,/', $rawQrBase64)) {
                $base64Body = preg_replace('/^data:image\/[a-zA-Z]+;base64,/', '', $rawQrBase64);
            } else {
                $base64Body = $rawQrBase64;
            }

            try {
                $imageData = base64_decode($base64Body);
                // cria imagem com Intervention
                $img = Image::make($imageData);

                // redimensiona mantendo aspect ratio. Ajuste 400 para o tamanho que preferir.
                $img->resize(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                // force PNG (QRs funcionam bem como PNG)
                $encoded = $img->encode('png'); // pode usar webp se quiser, mas png é seguro para leitura
                $smallBase64 = 'data:image/png;base64,' . base64_encode($encoded);
                $img->destroy();
            } catch (\Exception $e) {
                // fallback: enviar o QR original (ou null)
                $smallBase64 = 'data:image/png;base64,' . $base64Body;
            }
        }

        return response()->json([
            'status' => $payment->status ?? null,
            'qr_code' => $rawQr, // payload EMV (string do Pix) — útil para gerar QR no client com tamanho custom
            'qr_code_base64' => $smallBase64, // imagem já reduzida
            'expiration' => $payment->date_of_expiration ?? null
        ]);
    }
}
