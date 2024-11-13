<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
    ];

    public function listarMarca(Int $produtoId){
        $produtoMarca = Marca::where('id', $produtoId)->first();
        return $produtoMarca; 
    }
}
