<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Produto;

class Estoque extends Model
{
    protected $fillable = ['quantidade', 'produto_id', 'quantidadeP', 'quantidadeM', 'quantidadeG', 'quantidadeGG', 'quantidade775', 'quantidade8', 'quantidade825', 'quantidade85'];
    
    protected $table = 'estoques';
    
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id', 'id');
    }
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

    public function listarEstoqueTamanho(Int $produtoId, String $tamanho)
    {
        if (empty($produtoId)) {
            return null;
        } else {
            $produtoEstoque = Estoque::where('produto_id', $produtoId)->orWhere('quantidadeP' , $tamanho)->orWhere('quantidadeM' , $tamanho)->orWhere('quantidadeG' , $tamanho)->orWhere('quantidadeGG' , $tamanho)->orWhere('quantidade775' , $tamanho)->orWhere('quantidade8' , $tamanho)->orWhere('quantidade825' , $tamanho)->orWhere('quantidade85' , $tamanho)->first();
            return $produtoEstoque;
        }
    }
}
