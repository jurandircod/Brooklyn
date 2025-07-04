<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Produtos;

class Estoque extends Model
{
    protected $fillable = ['quantidade', 'produto_id', 'quantidadeP', 'quantidadeM', 'quantidadeG', 'quantidadeGG'];

    public function estoque()
    {
        return $this->hasOne(Estoque::class, 'produto_id', 'id');
    }

    public function listarEstoque(Int $produtoId)
    {
        if (empty($produtoId)) {
            return null;
        } else {
            $produtoEstoque = Estoque::where('produto_id', $produtoId)->first();
            return $produtoEstoque;
        }
    }
}
