<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('endereco_id')->nullable();
            $table->enum('status', ['aguardando', 'pago', 'enviado', 'entregue', 'cancelado'])->default('aguardando');
            $table->decimal('total', 10, 2);
            $table->timestamps();
            $table->string('metodo_pagamento');
            $table->string('data_pagamento')->nullable();
            $table->enum('status_pagamento', ['pendente', 'pago', 'entregue', 'cancelado'])->default('pendente');
            $table->string('codigo_rastreio')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('endereco_id')->references('id')->on('enderecos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
