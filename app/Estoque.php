<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Produtos;
class Estoque extends Model
{
    protected $fillable = ['quantidadeP', 'quantidadeM', 'quantidadeG', 'quantidadeGG', 'quantidade'];
    public function estoque()
    {
        return $this->hasOne(Estoque::class, 'produto_id', 'id');
    }

    public function listarEstoque(Int $produtoId){
        $produtoEstoque = Estoque::where('produto_id', $produtoId)->first();
        return $produtoEstoque; 
    }
}