<?php
// app/Http/Controllers/PedidoStatusController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidoStatusController extends Controller
{
    public function show(Request $request, $id)
    {
        $pedido = Pedido::find($id);

        if (!$pedido) {
            return response()->json(['error' => 'Pedido não encontrado'], 404);
        }

        // Retorne o status e dados úteis
        return response()->json([
            'status'     => $pedido->status,               // ex: pendente, pago, cancelled
            'updated_at' => $pedido->updated_at,
            'paid_at'    => $pedido->paid_at ?? null,
        ]);
    }
}
