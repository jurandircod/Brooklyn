<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class Estoque extends Model
{
    protected $fillable = ['quantidade', 'produto_id', 'tamanho', 'ativo'];
    
    protected $table = 'estoques';
    
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id', 'id');
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

    public function listarEstoqueTamanho(Int $produtoId, String $tamanho)
    {
        if (empty($produtoId)) {
            return null;
        } else {
            $produtoEstoque = Estoque::where('produto_id', $produtoId)->orWhere()->where('tamanho', $tamanho)->first();
            return $produtoEstoque;
        }
    }
}
