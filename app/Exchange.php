<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    protected $table = 'exchanges';
    protected $fillable = ['order_id', 'product_id', 'qty', 'qtytype_id', 'type', 'reason', 'desc'];
}
