<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='orders';
    protected $fillable=['order_id','key_name','key_value','order_type'];

    public function users()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function branch()
    {
        return $this->hasOne('App\Models\User','id','branch_id');
    }
}
