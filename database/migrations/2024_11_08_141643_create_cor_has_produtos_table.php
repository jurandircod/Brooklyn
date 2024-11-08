<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorHasProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cor_has_produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cor_id');
            $table->unsignedBigInteger('produto_id');
            $table->foreign('cor_id')->references('id')->on('cores');
            $table->foreign('produto_id')->references('id')->on('produtos');
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
        Schema::table('cor_has_produtos', function (Blueprint $table) {
            $table->dropForeign(['cor_id']);
            $table->dropForeign(['produto_id']);
        });
        Schema::dropIfExists('cor_has_produtos');
    }
}
