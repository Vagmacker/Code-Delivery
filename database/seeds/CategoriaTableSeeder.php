<?php
use CodeDelivery\Models\Produtos;
use CodeDelivery\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Categoria::class, 10)->create()->each(function($c) {
            for($i = 0; $i <= 5; $i++){
                $c->produtos()->save(factory(Produtos::class)->make());
            }
        });
    }
}
