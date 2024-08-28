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
        'note',
        'added_date',
        'total_amount',
        'paid_amount',
        'due_amount',
        'payment_type_id',
        'second_visit_comment',
        'second_visit_things',
        'third_visit_comment',
        'other_visit_comment',
        'next_day',
    ];

    protected $casts = [
        'treatments' => 'array', // Automatically cast treatments to array
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
