<?php

use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Brand::create([ 'name'  => 'xiangjiang', 'desc' => '' ]);
        \App\Brand::create([ 'name'  => 'donadoni', 'desc' => '' ]);
        \App\Brand::create([ 'name'  => 'lutviear', 'desc' => '' ]);
        \App\Brand::create([ 'name'  => 'jepang', 'desc' => '' ]);
        \App\Brand::create([ 'name'  => 'bandung', 'desc' => '' ]);
        \App\Brand::create([ 'name'  => 'y&x', 'desc' => '' ]);

    }
}
