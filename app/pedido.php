<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\endereco;

class pedido extends Model
{
    protected $table = 'pedidos';
    protected $fillable = ['user_id', 'endereco_id', 'status', 'total'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function endereco()
    {
        return $this->belongsTo(endereco::class, 'endereco_id');
    }
}
