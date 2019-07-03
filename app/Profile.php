<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
   protected $fillable = ['name', 'user_id', 'address', 'phone', 'photo', 'desc'];

   public function users(){
       return $this->belongsTo(Users::class);
   }
}
