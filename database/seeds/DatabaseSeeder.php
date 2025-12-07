<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Fotos, User, Pedido, Contato};

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Fotos::factory()->count(50)->create();
        User::factory()->count(50)->create();
        Pedido::factory()->count(50)->create();
        Contato::factory()->count(50)->create();
    }
}
