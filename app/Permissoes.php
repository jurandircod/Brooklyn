<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissoes extends Model
{
    protected $primaryKey = 'role_id';  // Define 'role' como chave primária
    public $incrementing = false;    // Indica que a chave primária não é auto-incremental
    protected $keyType = 'int';      // Define que a chave primária é do tipo int
    protected $fillable = ['role_id', 'tipo_acesso', 'descricao'];
}
