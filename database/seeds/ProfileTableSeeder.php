<?php

use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Profile::create(['name' => 'vicky', 'user_id' => 1, 'address' => 'bekasi']);
        App\Profile::create(['name' => 'erni', 'user_id' => 2, 'address' => 'bekasi']);
    }
}
