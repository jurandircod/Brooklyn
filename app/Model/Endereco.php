<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [ 'numero', 'bairro', 'cidade', 'estado', 'cep', 'logradouro', 'complemento', 'telefone', 'user_id', 'cpf'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
