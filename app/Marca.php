<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
    ];

    public function produtos()
    {
        return $this->hasMany(Produto::class, 'marca_id', 'id');
    }

    public function listarMarca(Int $produtoId){
        $produtoMarca = Marca::where('id', $produtoId)->first();
        return $produtoMarca; 
    }

    public function contarProdutosMarca(){
        $produtosMarca = $this->produtos()->count();
        return $produtosMarca;
    }
}
