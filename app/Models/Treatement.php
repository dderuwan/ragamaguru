<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatement extends Model
{
    use HasFactory;

    protected $table = 'Treatement';

    protected $fillable = [
        'name',
        'price',
        'status'
    ];
}
