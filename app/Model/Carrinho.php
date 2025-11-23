<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class Carrinho extends Model
{
    protected $fillable = ['user_id', 'status'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function itens()
    {
        return $this->hasMany(ItemCarrinho::class);
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }



}
