<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvaliacoesTable extends Migration
{
    /**
     * Cria a tabela 'avaliacoes'
     */
    public function up()
    {
        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('estrelas')->unsigned(); // de 1 a 5
            $table->text('comentario')->nullable();
            $table->timestamp('data_avaliacao')->useCurrent();

            // Relacionamentos (assumindo que as tabelas produtos e usuarios existem)
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Remove a tabela 'avaliacoes'
     */
    public function down()
    {
        Schema::dropIfExists('avaliacoes');
    }
}
