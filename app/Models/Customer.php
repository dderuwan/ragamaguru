<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Customer extends Pivot
{
    protected $table  = "customer";
    protected $fillable = ['name', 'contact', 'address', 'otp', 'isVerified', 'user_id', 'customer_type_id', 'registered_time', 'password', 'country_type_id', 'country_id'];


    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_code', 'id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointments::class, 'customer_id', 'id');
    }

    public function customerType()
    {
        return $this->belongsTo(CustomerType::class);
    }

    public function countryType()
    {
        return $this->belongsTo(CountryType::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
