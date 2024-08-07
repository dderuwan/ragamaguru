<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApNumbers extends Model
{
    use HasFactory;

    protected $table = 'ap_numbers';

    protected $fillable = [
        'number','timeslot','status', 
    ];
}
