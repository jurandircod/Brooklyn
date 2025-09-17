<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $hidden = ['produtos'];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    public function tamanho()
    {
        return $this->hasMany(Tamanho::class);
    }
    protected $fillable = ['nome', 'descricao'];

    public function listarCategoria(Int $produtoId)
    {
        $produtoCategoria = Categoria::where('id', $produtoId)->first();
        return $produtoCategoria;
    }

    public function contarProdutosCategoria()
    {
        $produtosCategoria = $this->produtos()->count();
        return $produtosCategoria;
    }
}
