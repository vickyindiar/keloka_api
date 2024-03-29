<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password' , 'role_id',
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function roles(){
        return $this->belongsTo(Role::class);
    }

    public function profiles(){
        return $this->hasOne(Profile::class);
    }

    public function Orders(){
        return $this->hasMany(Order::class);
    }

}
