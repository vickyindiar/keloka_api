<?php

use Illuminate\Database\Seeder;

class ColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Color::create(['name' => 'campur', 'desc' => '']);
        App\Color::create(['name' => 'motif', 'desc' => '']);
        App\Color::create(['name' => 'hitam', 'desc' => '']);
        App\Color::create(['name' => 'putih', 'desc' => '']);
        App\Color::create(['name' => 'hitam putih', 'desc' => '']);
        App\Color::create(['name' => 'cream', 'desc' => '']);
        App\Color::create(['name' => 'coklat', 'desc' => '']);
        App\Color::create(['name' => 'biru', 'desc' => '']);
        App\Color::create(['name' => 'abu', 'desc' => '']);
        App\Color::create(['name' => 'merah', 'desc' => '']);
        App\Color::create(['name' => 'hijau', 'desc' => '']);
        App\Color::create(['name' => 'kuning', 'desc' => '']);
        App\Color::create(['name' => 'ungu', 'desc' => '']);
    }
}
