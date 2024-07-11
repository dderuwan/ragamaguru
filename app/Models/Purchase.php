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
        'status',
        'date',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->request_code = self::generateRequestcode();
        });
    }

    private static function generateRequestcode()
    {
        $randomString = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10); 
        return 'ORDREQ-' . $randomString;
    }
}
