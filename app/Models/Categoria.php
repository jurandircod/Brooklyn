<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Categoria extends Model
{
    protected $table = 'categorias';
    protected $hidden = ['produtos'];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
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
