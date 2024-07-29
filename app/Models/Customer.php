<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Customer extends Pivot
{
    protected $table  = "customer";
    protected $fillable = ['name','contact','address','otp','isVerified','user_id','customer_type','registered_time'];


    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_code', 'id');
    }
}
