<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartPaymentTypes extends Model
{
    use HasFactory;

    protected $table = 'cart_payment_types';

    protected $fillable = [
        'name', 
    ];
}
