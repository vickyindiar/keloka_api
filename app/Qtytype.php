<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qtytype extends Model
{
    protected $table    = 'qtytypes';
    protected $fillable = ['code', 'name', 'desc'];

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function order_details(){
        return $this->hasMany(OrderDetail::class);
    }

    public function exchanges(){
        return $this->hasMany(Exchange::class);
    }

    public function rejects(){
        return $this->hasMany(Reject::class);
    }
}
