<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = 'avaliacoes';
    protected $fillable = ['user_id', 'produto_id', 'estrela', 'comentario'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function produto()
    {
        return $this->belongsTo(produto::class, 'produto_id');
    }
}
