<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Produtos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('produtos', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->double('valor');
        $table->string('material')->nullable();
        $table->string('tamanho')->nullable();
        $table->integer('quantidade')->default(0);
        $table->unsignedBigInteger('categoria_id');
        $table->foreign('categoria_id')->references('id')->on('categorias');
        $table->unsignedBigInteger('marca_id')->nullable();
        $table->foreign('marca_id')->references('id')->on('marcas');
        $table->string('url_imagem');
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
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropForeign(['categoria_id']);
            $table->dropForeign(['marca_id']);
        });
        
        Schema::dropIfExists('produtos');
    }
}
