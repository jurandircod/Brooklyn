<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ItemCarrinho;

class Carrinho extends Model
{
    protected $fillable = ['user_id', 'status'];


    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function itens()
    {
        return $this->hasMany(ItemCarrinho::class);
    }
}
