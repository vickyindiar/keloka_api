<?php

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
        \App\User::create(['name' => 'vicky', 'email' => 'vicky@mail.com', 'password' => 'adminadmin', 'role_id' => 1]);
        \App\User::create(['name' => 'erni', 'email' => 'erni@mail.com', 'password' => '12345678', 'role_id' => 2]);

    }
}
