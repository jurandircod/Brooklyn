<?php

namespace App;
use App\Carrinho;
use App\Produtos;
use Illuminate\Database\Eloquent\Model;

class ItemCarrinho extends Model
{
    protected $table = 'item_carrinhos';

    protected $fillable = [
        'carrinho_id',
        'produto_id',
        'quantidade',
        'preco_unitario',
        'preco_total',
    ];

    public function carrinho()
    {
        return $this->belongsTo(Carrinho::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produtos::class);
    }
}

