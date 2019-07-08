<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = ['name', 'address', 'city', 'province', 'phone', 'phone2', 'store', 'photo', 'desc' ];

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
