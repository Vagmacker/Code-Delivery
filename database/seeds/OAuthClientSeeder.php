<?php

use Illuminate\Database\Seeder;

class OAuthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('delivery.oauth_clients')->insert([
            [
                'id' => 'appid01',
                'secret' => 'secret',
                'name' => 'Minha aplicação',
                'created_at' =>  '05/07/2016',
                'updated_at' =>  '05/07/2016',
            ]
        ]);
    }
}
