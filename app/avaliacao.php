<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class avaliacao extends Model
{
    protected $table = 'avaliacao';
    protected $fillable = ['user_id', 'produto_id', 'nota'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function produto()
    {
        return $this->belongsTo(produto::class, 'produto_id');
    }
}
