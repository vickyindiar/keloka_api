<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';
    protected $fillable = ['name', 'sprice' , 'bprice', 'qtytype_id', 'stock', 'category_id', 'supplier_id', 'color', 'image', 'desc' ];
}
