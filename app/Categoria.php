<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{

    public function produtos()
    {
        return $this->hasMany(Produtos::class);
    }
    protected $fillable = ['nome', 'descricao'];

    public function listarCategoria(Int $produtoId){
        $produtoCategoria = Categoria::where('id', $produtoId)->first();
        return $produtoCategoria; 
    }
}
