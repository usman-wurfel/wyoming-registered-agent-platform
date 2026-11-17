<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lname','email', 'password', 'is_admin','gender','birthday','image','address','zip_code','city'
        ,'state','apt'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function payment(){
        return $this->hasOne(UserPayment::class,'user_id','id');
    }
    public function lastPayment(){
        return $this->hasMany(UserPayment::class,'user_id','id');
    }
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
