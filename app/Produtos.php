<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    
    protected $fillable = ['nome', 'valor', 'material', 'categoria_id', 'marca_id', 'descricao', 'largura'];
    // Define o relacionamento "uma categoria tem muitos produtos"
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function estoque()
    {
        return $this->hasOne(Estoque::class, 'produto_id', 'id');
    }
}
