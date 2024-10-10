<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissoes extends Model
{
    protected $fillable = ['role', 'tipo_acesso', 'descricao'];
}
