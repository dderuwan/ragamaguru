<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryType extends Model
{
    use HasFactory;

    protected $table = 'country_type';

    protected $fillable = [
        'name',
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
