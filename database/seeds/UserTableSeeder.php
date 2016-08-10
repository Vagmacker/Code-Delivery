<?php

use CodeDelivery\Models\Cliente;
use CodeDelivery\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'User',
            'email' => "user@user.com",
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
        ])->cliente()->save(factory(Cliente::class)->make());

        factory(User::class)->create([
            'name' => 'Admin',
            'email' => "admin@user.com",
            'password' => bcrypt(123456),
            'role'=> 'admin',
            'remember_token' => str_random(10),
        ])->cliente()->save(factory(Cliente::class)->make());

        factory(User::class)->create([
            'name' => 'Deliveryman',
            'email' => "deliveryman@user.com",
            'password' => bcrypt(123456),
            'role'=> 'entregador',
            'remember_token' => str_random(10),
        ])->cliente()->save(factory(Cliente::class)->make());

        factory(User::class, 10)->create()->each(function($u) {
            $u->cliente()->save(factory(Cliente::class)->make());
        });

        factory(User::class, 3)->create([
            'role'=>'entregador',
        ]);
    }
}
