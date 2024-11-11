<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    
    protected $fillable = ['nome', 'valor', 'material', 'quantidade','tamanho', 'categoria_id', 'marca_id', 'descricao'];
    // Define o relacionamento "uma categoria tem muitos produtos"
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
