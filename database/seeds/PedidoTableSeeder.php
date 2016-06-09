<?php

use CodeDelivery\Models\Pedidos;
use CodeDelivery\Models\PedidosItem;
use Illuminate\Database\Seeder;

class PedidoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Pedidos::class, 10)->create()->each(function($p){
           for($i = 0; $i <= 2; $i++)
           {
               $p->items()->save(factory(PedidosItem::class)->make([
                    'produto_id'=>rand(1,5),
                    'qtd'=>2,
                    'valor'=> 50
               ]));
           }
        });
    }
}
