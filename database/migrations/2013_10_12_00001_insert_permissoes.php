<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class InsertPermissoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('permissoes')->insert([
            [
                'role_id' => 3,
                'tipo_acesso' => 'Fornecedores',
                'descricao' => 'Fornecedores de produtos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 2,
                'tipo_acesso' => 'user',
                'descricao' => 'Usuário comum',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 1,
                'tipo_acesso' => 'guest',
                'descricao' => 'Convidado',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 10,
                'tipo_acesso' => 'admin',
                'descricao' => 'Administrador do sistema',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('permissoes')->whereIn('role_id', [1, 2, 3])->delete();
    }
}
