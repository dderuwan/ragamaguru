<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table  = "suppliers";

    protected $fillable = [
        'supplier_code',
        'name',
        'contact',
        'address',
        'supplier_type',
        'registered_time'
    ];


    /**
     * Boot function from Laravel.
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->supplier_code = self::generateSupplierCode();
        });
    }

    
    private static function generateSupplierCode()
    {
        // Generate a random string of characters
        $randomString = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10); 

        // Combine with prefix
        return 'SUP-' . $randomString;
    }
}
