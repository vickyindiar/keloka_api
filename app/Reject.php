<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reject extends Model
{
    protected $table    = 'rejects';
    protected $fillable = ['product_id', 'qty', 'qtytype_id'];

    public function products(){
        return $this->belongsTo(Product::class);
    }
}
