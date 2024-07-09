<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table  = "item";

    protected $fillable = [
        'item_code',
        'image',
        'name',
        'description',
        'quantity',
        'price',
        'supplier_code',
    ];

   

    /**
     * Boot function from Laravel.
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->item_code = self::generateItemCode();
        });
    }

    
    private static function generateItemCode()
    {
        // Generate a random string of characters
        $randomString = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 5); 

        // Combine with prefix
        return 'ITEM-' . $randomString;
    }
}
