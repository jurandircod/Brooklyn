<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstoquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estoques', function (Blueprint $table) {
            $table->id();
            $table->double('quantidade')->default(0);
            $table->unsignedBigInteger('produto_id')->unique();
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->double('quantidadeP')->default(0);
            $table->double('quantidadeM')->default(0);
            $table->double('quantidadeG')->default(0);
            $table->double('quantidadeGG')->default(0);
            $table->double('quantidade775')->default(0);
            $table->double('quantidade8')->default(0);
            $table->double('quantidade825')->default(0);
            $table->double('quantidade85')->default(0);
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
        Schema::table('estoques', function (Blueprint $table) {
            $table->dropForeign(['produto_id']);
        });
        Schema::dropIfExists('estoques');
    }
}
