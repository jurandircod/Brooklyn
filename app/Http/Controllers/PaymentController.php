<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MercadoPagoService;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $mpService;

    public function __construct(MercadoPagoService $mpService)
    {
        $this->mpService = $mpService;
    }

    /**
     * Rota que processa o pagamento PIX e retorna a view com os dados do PIX.
     */
    public function payWithPix(Request $request)
    {
        $data = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
            'email' => 'required|email',
            'first_name' => 'required|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'cpf' => 'nullable|string'
        ]);

        try {
            $customer = [
                'email' => $data['email'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'] ?? '',
                'cpf' => $data['cpf'] ?? null
            ];

            Log::info('Pagamento PIX solicitado via controller', ['amount' => $data['amount']]);

            $pixData = $this->mpService->createPixPayment(
                $data['amount'],
                $data['description'] ?? 'Pagamento',
                $customer
            );

            // Retorna view (crie resources/views/payments/pix.blade.php)
            return view('payments.pix', compact('pixData'));
        } catch (\Exception $e) {
            Log::error('Erro em PaymentController@payWithPix: ' . $e->getMessage());
            return back()->withErrors('Não foi possível gerar o PIX: ' . $e->getMessage());
        }
    }
}
