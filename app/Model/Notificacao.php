<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    public static function NotificacaoContador()
    {
        $num = Pedido::where('status', 'aguardando');
        $num = $num->count();
        return $num;
    }

    public static function notificacaoPedido(){
        $notificacao = Pedido::where('status', 'aguardando')->paginate(4);
        return $notificacao;
    }
}
