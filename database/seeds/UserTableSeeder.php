<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create(['name' => 'vicky', 'email' => 'vicky@mail.com', 'password' => Hash::make('adminadmin'), 'role_id' => 1]);
        \App\User::create(['name' => 'erni', 'email' => 'erni@mail.com', 'password' =>  Hash::make('12345678'), 'role_id' => 2]);

    }
}
