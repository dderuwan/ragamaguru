<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table  = "purchase_order";

    protected $fillable = [
        'request_code',
        'item_code',
        'supplier_code',
        'inquantity',
        'order_quantity',
        'price',
        'status',
    ];

   

    /**
     * Boot function from Laravel.
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->request_code = self::generateRequestcode();
        });
    }

    
    private static function generateRequestcode()
    {
        // Generate a random string of characters
        $randomString = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 5); 

        // Combine with prefix
        return 'REQ-' . $randomString;
    }
}
