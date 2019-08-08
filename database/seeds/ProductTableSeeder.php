<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Supplier::create([
            'name' => 'SMP', 'sprice' => 20000, 'bprice' => 18000, 'qtytype_id' => 3,  'stock' => 120,
            'category_id' => 1, 'supplier_id' => 2, 'brand_id' => 3, 'color_id' => 5,
            'desc' => ''
        ]);

        App\Supplier::create([
            'name' => 'SMP', 'sprice' => 20000, 'bprice' => 18000, 'qtytype_id' => 3,  'stock' => 79,
            'category_id' => 1, 'supplier_id' => 2, 'brand_id' => 3, 'color_id' => 3,
            'desc' => ''
        ]);

        App\Supplier::create([
            'name' => 'SMP', 'sprice' => 20000, 'bprice' => 18000, 'qtytype_id' => 3,  'stock' => 25,
            'category_id' => 1, 'supplier_id' => 2, 'brand_id' => 3, 'color_id' => 4,
            'desc' => ''
        ]);

        App\Supplier::create([
            'name' => 'SD', 'sprice' => 18000, 'bprice' => 15000, 'qtytype_id' => 3,  'stock' => 36,
            'category_id' => 1, 'supplier_id' => 2, 'brand_id' => 3, 'color_id' => 5,
            'desc' => ''
        ]);


        App\Supplier::create([
            'name' => 'SD', 'sprice' => 18000, 'bprice' => 15000, 'qtytype_id' => 3,  'stock' => 225,
            'category_id' => 1, 'supplier_id' => 2, 'brand_id' => 3, 'color_id' => 4,
            'desc' => ''
        ]);


        App\Supplier::create([
            'name' => 'SD', 'sprice' => 18000, 'bprice' => 15000, 'qtytype_id' => 3,  'stock' => 456,
            'category_id' => 1, 'supplier_id' => 2, 'brand_id' => 3, 'color_id' => 3,
            'desc' => ''
        ]);

        App\Supplier::create([
            'name' => 'SMA', 'sprice' => 25000, 'bprice' => 22000, 'qtytype_id' => 3,  'stock' => 321,
            'category_id' => 1, 'supplier_id' => 2, 'brand_id' => 3, 'color_id' => 5,
            'desc' => ''
        ]);

        App\Supplier::create([
            'name' => 'SMA', 'sprice' => 25000, 'bprice' => 22000, 'qtytype_id' => 3,  'stock' => 125,
            'category_id' => 1, 'supplier_id' => 2, 'brand_id' => 3, 'color_id' => 4,
            'desc' => ''
        ]);

        App\Supplier::create([
            'name' => 'SMA', 'sprice' => 25000, 'bprice' => 22000, 'qtytype_id' => 3,  'stock' => 127,
            'category_id' => 1, 'supplier_id' => 2, 'brand_id' => 3, 'color_id' => 3,
            'desc' => ''
        ]);


        App\Supplier::create([
            'name' => 'XIONGXING', 'sprice' => 42000, 'bprice' => 30000, 'qtytype_id' => 3,  'stock' => 62,
            'category_id' => 2, 'supplier_id' => 5, 'brand_id' => 1, 'color_id' => 3,
            'desc' => ''
        ]);

        App\Supplier::create([
            'name' => 'KERJA PANJANG', 'sprice' => 42000, 'bprice' => 30000, 'qtytype_id' => 3,  'stock' => 12,
            'category_id' => 2, 'supplier_id' => 4, 'brand_id' => 5, 'color_id' => 3,
            'desc' => ''
        ]);

        App\Supplier::create([
            'name' => 'KERJA PENDEK', 'sprice' => 35000, 'bprice' => 2000, 'qtytype_id' => 3,  'stock' => 16,
            'category_id' => 2, 'supplier_id' => 4, 'brand_id' => 5, 'color_id' => 3,
            'desc' => ''
        ]);

        App\Supplier::create([
            'name' => 'SPORT PANJANG', 'sprice' => 78000, 'bprice' => 35000, 'qtytype_id' => 1,  'stock' => 60,
            'category_id' => 6, 'supplier_id' => 3, 'brand_id' => 2, 'color_id' => 3,
            'desc' => ''
        ]);

        App\Supplier::create([
            'name' => 'SPORT PENDEK', 'sprice' => 58000, 'bprice' => 30000, 'qtytype_id' => 1,  'stock' => 28,
            'category_id' => 6, 'supplier_id' => 3, 'brand_id' => 2, 'color_id' => 4,
            'desc' => ''
        ]);

        App\Supplier::create([
            'name' => 'BOLA', 'sprice' => 98000, 'bprice' => 80000, 'qtytype_id' => 1,  'stock' => 85,
            'category_id' => 6, 'supplier_id' => 3, 'brand_id' => 2, 'color_id' => 2,
            'desc' => ''
        ]);

        App\Supplier::create([
            'name' => 'SPORT HIDDEN', 'sprice' => 56000, 'bprice' => 45000, 'qtytype_id' => 1,  'stock' => 63,
            'category_id' => 6, 'supplier_id' => 3, 'brand_id' => 2, 'color_id' => 5,
            'desc' => ''
        ]);

        App\Supplier::create([
            'name' => 'TK 1/3', 'sprice' => 28000, 'bprice' => 20000, 'qtytype_id' => 1,  'stock' => 75,
            'category_id' => 4, 'supplier_id' => 1, 'brand_id' => 3, 'color_id' => 2,
            'desc' => ''
        ]);

        App\Supplier::create([
            'name' => 'TK 4/6', 'sprice' => 28000, 'bprice' => 20000, 'qtytype_id' => 1,  'stock' => 20,
            'category_id' => 4, 'supplier_id' => 1, 'brand_id' => 3, 'color_id' => 2,
            'desc' => ''
        ]);

        App\Supplier::create([
            'name' => 'TK 6/10', 'sprice' => 29000, 'bprice' => 21000, 'qtytype_id' => 1,  'stock' => 20,
            'category_id' => 4, 'supplier_id' => 1, 'brand_id' => 3, 'color_id' => 2,
            'desc' => ''
        ]);

        App\Supplier::create([
            'name' => 'STOKING MK', 'sprice' => 56000, 'bprice' => 49000, 'qtytype_id' => 1,  'stock' => 25,
            'category_id' => 3, 'supplier_id' => 6, 'brand_id' => 6, 'color_id' => 6,
            'desc' => ''
        ]);

        App\Supplier::create([
            'name' => 'STOKING BETIS', 'sprice' => 59000, 'bprice' => 52000, 'qtytype_id' => 1,  'stock' => 25,
            'category_id' => 3, 'supplier_id' => 6, 'brand_id' => 6, 'color_id' => 6,
            'desc' => ''
        ]);

        App\Supplier::create([
            'name' => 'STOKING PANJANG', 'sprice' => 66000, 'bprice' => 59000, 'qtytype_id' => 1,  'stock' => 2,
            'category_id' => 3, 'supplier_id' => 6, 'brand_id' => 6, 'color_id' => 6,
            'desc' => ''
        ]);

        App\Supplier::create([
            'name' => 'STOKING CELANA', 'sprice' => 76000, 'bprice' => 69000, 'qtytype_id' => 1,  'stock' => 13,
            'category_id' => 3, 'supplier_id' => 6, 'brand_id' => 6, 'color_id' => 6,
            'desc' => ''
        ]);

    }
}
