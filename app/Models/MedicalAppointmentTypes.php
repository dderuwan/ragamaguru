<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalAppointmentTypes extends Model
{
    use HasFactory;
    protected $table = 'medical_appointment_type';

    protected $fillable = [
        'type','price','for_whom','status', 
    ];
}
