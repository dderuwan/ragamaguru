<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDetails extends Model
{
    use HasFactory;

    protected $table  = "company_details";

    protected $fillable = [
        'title',
        'address',
        'email',
        'contact',
        'logo',
        'website',
        'yt_channel_id',
        'fb_page_url',
        'poweredbytext',
        'footertext',
    ];
}
