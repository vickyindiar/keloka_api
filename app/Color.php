<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';
    protected $fillable = ['name', 'desc'];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
