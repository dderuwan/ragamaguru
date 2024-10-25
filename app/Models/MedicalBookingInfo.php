<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalBookingInfo extends Model
{
    use HasFactory;

    protected $table = 'medical_booking_info';

    protected $fillable = [
        'info_text', 
    ];
}
