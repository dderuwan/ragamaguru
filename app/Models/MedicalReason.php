<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalReason extends Model
{
    use HasFactory;

    protected $table = 'medical_reason';

    protected $fillable = [
        'reason','status', 
    ];
}
