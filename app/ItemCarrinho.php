<?php

namespace App;

use App\Carrinho;

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
        'tamanho'
    ];

    public function carrinho()
    {
        return $this->belongsTo(Carrinho::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function VerificaItemCarrinho($carrinhoId, $produtoId, $tamanho)
    {
          return ItemCarrinho::where('carrinho_id', $carrinhoId)
        ->whereHas('carrinho', function ($query) {
            $query->where('status', 'ativo');
        })
        ->where('produto_id', $produtoId)
        ->where('tamanho', $tamanho)
        ->first();
    }
}
