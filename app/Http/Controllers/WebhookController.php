<?php

// app/Http/Controllers/WebhookController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payment_id = $request->input('data.id');
        $payment = \MercadoPago\Payment::find_by_id($payment_id);
        
        // Encontre o pedido relacionado
        $order = Order::where('payment_id', $payment_id)->first();
        
        if ($order && $payment) {
            switch ($payment->status) {
                case 'approved':
                    $order->update(['status' => 'paid']);
                    break;
                case 'pending':
                    $order->update(['status' => 'pending']);
                    break;
                case 'cancelled':
                    $order->update(['status' => 'cancelled']);
                    break;
            }
        }
        
        return response()->json(['status' => 'success']);
    }
}
