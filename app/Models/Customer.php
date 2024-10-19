<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
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

    // Hide the password and remember token
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }
}
