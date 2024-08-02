<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "pos";
    protected $fillable = [
        'order_code', 
        'customer_code', 
        'date',  
        'total_cost_payment', 
        'discount',
        'vat',
        'paid_amount',
        'change',
        'payment_type',
        'sub_total',
        'shipping_cost',
        'order_type',
        'order_status_id'
    ];

    public function items()
    {
        return $this->hasMany(OrderItems::class, 'pos_id');
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');  
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_code', 'id');
    }
}
