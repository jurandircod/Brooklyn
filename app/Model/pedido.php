<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class pedido extends Model
{
    protected $table = 'pedidos';
    protected $fillable = ['user_id', 'endereco_id', 'status', 'total', 'preco_total', 'metodo_pagamento', 'data_pagamento', 'status_pagamento', 'codigo_rastreio'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function endereco()
    {
        return $this->belongsTo(endereco::class, 'endereco_id');
    }

}
