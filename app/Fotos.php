<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fotos extends Model
{
    protected $fillable = ['url_imagem', 'produto_id'];
    // Define o relacionamento "um produto tem muitas fotos"
    public function produto()
    {
        return $this->belongsTo(Produtos::class);
    }
}
