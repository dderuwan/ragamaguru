<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrderItems extends Model
{
    use HasFactory;

    protected $table = 'customer_order_items';

    protected $fillable = [
        'cus_order_id','item_code','item_name','quantity'     
    ];
}
