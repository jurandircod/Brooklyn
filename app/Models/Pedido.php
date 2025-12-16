<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $fillable = ['user_id', 'endereco_id', 'status', 'total', 'preco_total', 'metodo_pagamento', 'data_pagamento', 'status_pagamento', 'codigo_rastreio', 'carrinho_id'];

    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'endereco_id');
    }

    public function carrinho()
    {
        return $this->belongsTo(Carrinho::class, 'carrinho_id');
    }

}
