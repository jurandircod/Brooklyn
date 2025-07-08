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

    public function fotos()
    {
        return $this->hasMany(Fotos::class, 'produto_id');
        //                     Modelo filho ↑   ↑ Coluna real no banco
    }

    // metodo acessor de helper
    public function getImagemUrlAttribute()
    {
        return \App\Helpers\ImagemHelper::imagemDoProduto($this->id);
    }

    public function getImagemPastaAttribute()
    {
        return \App\Helpers\ImagemHelper::pastaImagensProduto($this->id);
    }

    public function estoque()
    {
        return $this->hasOne(Estoque::class, 'produto_id', 'id');
    }
}
