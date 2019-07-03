<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    protected $fillable = ['name', 'address', 'city', 'province', 'phone', 'phone2', 'store', 'photo', 'desc' ];
}
