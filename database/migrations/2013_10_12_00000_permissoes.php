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
        $table->bigIncrements('role_id'); // Altere para bigIncrements
        $table->string('tipo_acesso')->unique();
        $table->string('descricao');
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
