<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalTreat extends Model
{
    use HasFactory;

    protected $table = 'medical_treat';  

    protected $fillable = [
        'name',
        'amount',
        'things_to_bring',
        'status'
    ];
}
