<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Isso só funcionará depois de converter todas as factories
        \App\Models\Fotos::factory()->count(50)->create();
        \App\Models\User::factory()->count(50)->create();
        \App\Models\Pedido::factory()->count(50)->create();
        \App\Models\Contato::factory()->count(50)->create();
    }
}