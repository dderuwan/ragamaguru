<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OfferItems extends Pivot
{
    protected $table = 'offer_item';

    protected $fillable = [
        'item_id' ,
        'normal_price' ,
        'offer_rate' ,
        'offer_price' ,
        'month' ,
        'status' ,
        'added_date',
    ];
}
