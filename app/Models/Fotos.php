<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Fotos extends Model
{
    protected $fillable = ['url_imagem', 'produto_id'];
    // Define o relacionamento "um produto tem muitas fotos"
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
