<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'customer_id','booking_date','added_date', 
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
