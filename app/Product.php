<?php

namespace App;

use App\Qtytype;
use App\Category;
use App\Supplier;
use App\Brand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';
    protected $fillable = ['name', 'sprice' , 'bprice', 'qtytype_id', 'stock', 'category_id', 'supplier_id', 'color', 'image', 'desc' ];

    public function qtytype(){
        return $this->belongsTo(Qtytype::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

}
