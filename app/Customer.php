<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $table = 'customers';
    protected $fillable = ['name', 'address', 'city', 'province', 'phone', 'phone2', 'store', 'photo', 'desc' ];

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
