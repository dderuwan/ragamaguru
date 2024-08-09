<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Appointments extends Pivot
{
    protected $table = 'appointments';

    protected $fillable = [
        'customer_id','date','ap_numbers_id','visit_day','added_date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function apNumber()
{
    return $this->belongsTo(ApNumbers::class, 'ap_numbers_id');
}
}
