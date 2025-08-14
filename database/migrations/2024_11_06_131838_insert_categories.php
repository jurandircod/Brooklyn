<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class InsertCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('categorias')->insert([
            ['nome' => 'Camisas'],
            ['nome' => 'Skates'],
            ['nome' => 'Tênis']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categorias')->whereIn('nome', ['Camisas', 'Skates', 'Tênis'])->delete();
    }
}
