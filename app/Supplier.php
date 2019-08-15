<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $table     = 'suppliers';
    protected $fillable  = ['name', 'address', 'city', 'province', 'phone', 'phone2', 'store', 'photo', 'desc' ];

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
    //protected $dates     = ['deleted_at'];
}
