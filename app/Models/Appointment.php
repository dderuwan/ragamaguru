<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'appointments';

    protected $fillable = [
        'customer_id',
        'note' ,
        'event_type' ,
        'start_date' ,
        'end_date',
        'start_time' ,
        'end_time' 
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    
    public function getFormattedStartTimeAttribute()
    {
        return date('h:i A', strtotime($this->attributes['start_time']));
    }

    public function getFormattedEndTimeAttribute()
    {
        return date('h:i A', strtotime($this->attributes['end_time']));
    }
}
