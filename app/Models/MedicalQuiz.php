<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalQuiz extends Model
{
    use HasFactory;

    protected $table = 'medical_quiz';

    protected $fillable = [
        'quiz','status', 
    ];
}
