<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table    = 'roles';
    protected $fillable = ['nama_role'];

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
