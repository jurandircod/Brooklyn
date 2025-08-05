<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $fillable = ['nome', 'sobrenome', 'email', 'telefone', 'mensagem', 'status'];
}
