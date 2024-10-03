<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [ 'numero', 'bairro', 'cidade', 'estado', 'cep', 'logradouro', 'complemento', 'telefone'];
}
