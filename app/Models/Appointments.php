<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Appointments extends Pivot
{

    protected $table = 'appointments';

    protected $fillable = [
        'customer_id',
        'date',
        'ap_numbers_id',
        'visit_day',
        'created_by',
        'created_user_id',
        'appointment_type_id',
        'total_amount',
        'paid_amount',
        'due_amount',
        'payment_method',
        'payment_type_id',
        'added_date',
        'is_booking',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function apNumber()
    {
        return $this->belongsTo(ApNumbers::class, 'ap_numbers_id');
    }

    public function appointmentType()
    {
        return $this->belongsTo(AppointmentType::class, 'appointment_type_id');
    }

    public function visitDay()
    {
        return $this->belongsTo(VisitType::class, 'visit_day');
    }
}
