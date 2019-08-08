<?php

use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Supplier::create(['name' => 'jhon', 'address' => 'babelan', 'city' => 'bekasi']);
        App\Supplier::create(['name' => 'obi', 'address' => 'kebalen', 'city' => 'bekasi']);
        App\Supplier::create(['name' => 'micahel', 'address' => 'jatiwaringin', 'city' => 'bekasi']);
        App\Supplier::create(['name' => 'steve', 'address' => 'kuningan', 'city' => 'jakarta']);
        App\Supplier::create(['name' => 'mahmud', 'address' => 'bantul', 'city' => 'jogja']);
        App\Supplier::create(['name' => 'yota', 'address' => 'mampang', 'city' => 'jakarta']);
    }
}
