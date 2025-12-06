<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    protected $table = 'permissoes';
    protected $primaryKey = 'role_id';  // Define 'role' como chave primária
    public $incrementing = false;    // Indica que a chave primária não é auto-incremental
    protected $keyType = 'int';      // Define que a chave primária é do tipo int
    protected $fillable = ['role_id', 'tipo_acesso', 'descricao'];

    public function user()
    {
        return $this->belongsToMany(User::class, 'permissoes_users', 'role_id', 'user_id');
    }
}
