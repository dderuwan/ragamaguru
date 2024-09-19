<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTreatments extends Model
{
    use HasFactory;

    protected $table = 'customer_treatments';

    protected $fillable = [
        'customer_id',
        'appointment_id',
        'treatments', // JSON field to store treatment IDs
        'selected_treatments',
        'added_date',
        'total_amount',
        'paid_amount',
        'due_amount',
        'payment_type_id',
        'comment', 
        'things_to_bring', 
        'next_day',
    ];

    protected $casts = [
        'treatments' => 'array', // Automatically cast treatments to array
        'selected_treatments'=>'array',
    ];

    

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointments::class);
    }
}
