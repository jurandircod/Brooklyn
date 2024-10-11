<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Permissoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissoes', function (Blueprint $table) {
            $table->integer('role_id')->primary()->unique();      // Definir como único                           // Definir 'role' como chave primária
            $table->string('tipo_acesso')->unique();// Outro campo único (slug ou nome da role)
            $table->string('descricao');            // Descrição da role
            $table->timestamps();   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissoes'); 
    }
}
