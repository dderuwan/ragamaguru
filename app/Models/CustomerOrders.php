<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrders extends Model
{
    use HasFactory;

    protected $table = 'customer_orders';

    protected $fillable = [
        'cus_order_code', 'customer_code', 'date', 'sub_total', 'shipping_cost', 'grand_total', 'paid_amount', 'payment_type', 'order_status_id'    
    ];
}
