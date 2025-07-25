<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    const GUEST = 1;
    const USER = 2;
    const FORNECEDOR = 3;
    const ADMIN = 10;
    
    protected $table = 'permissoes';
    protected $fillable = ['role_id', 'tipo_acesso', 'descricao'];
    
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
