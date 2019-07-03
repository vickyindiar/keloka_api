<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'sprice' , 'bprice', 'qtytype_id', 'stock', 'category_id', 'supplier_id', 'color', 'image', 'desc' ];

}
