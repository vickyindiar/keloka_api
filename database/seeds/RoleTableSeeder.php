<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Role::create([ 'name'  => 'Super Admin' ]);
        \App\Role::create([ 'name'  => 'Admin' ]);
    }
}
