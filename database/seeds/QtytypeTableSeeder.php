<?php

use Illuminate\Database\Seeder;

class QtytypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Qtytype::create(['code' => 'pcs', 'name' => 'piece', 'desc' => '1']);
        \App\Qtytype::create(['code' => 'pck', 'name' => 'pack', 'desc' => '10']);
        \App\Qtytype::create(['code' => 'lsn', 'name' => 'lusin', 'desc' => '12']);
        \App\Qtytype::create(['code' => 'kd', 'name' => 'kodi', 'desc' => '20']);
    }
}
