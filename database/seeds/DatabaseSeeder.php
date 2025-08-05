<?php

use Illuminate\Database\Seeder;
use App\Model\{Fotos, User, Pedido, Contato};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
            // Cria 50 produtos com fotos e estoque relacionados
        for ($i = 0; $i < 50; $i++) {
            // Isso automaticamente criará o produto, estoque e fotos
            factory(Fotos::class)->create();
            factory(User::class)->create();
            factory(Pedido::class)->create();
            factory(Contato::class)->create();
        }

        
    }
}
