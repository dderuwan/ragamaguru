<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerMedicalInfo extends Model
{
    use HasFactory;
    protected $table = 'customer_medical_info';

    protected $fillable = [
        'customer_id','quiz_id', 'answer',
    ];
}
