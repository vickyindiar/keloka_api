<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Category::create([ 'code'  => 'SKL', 'name' => 'sekolah', 'desc' => 'sd smp sma' ]);
        \App\Category::create([ 'code'  => 'PRA', 'name' => 'pria', 'desc' => 'kerja' ]);
        \App\Category::create([ 'code'  => 'MSL', 'name' => 'muslim', 'desc' => '' ]);
        \App\Category::create([ 'code'  => 'TK', 'name' => 'tk', 'desc' => '' ]);
        \App\Category::create([ 'code'  => 'MST', 'name' => 'manset', 'desc' => '' ]);
        \App\Category::create([ 'code'  => 'SPT', 'name' => 'sport', 'desc' => '' ]);
    }
}
