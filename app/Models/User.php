<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class User extends Model implements AuthenticatableContract
{
    use HasFactory;
    use HasRoles;
    use Authenticatable;
    
    protected $table  = "users";

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'about',
        'image',
        'user_type',
        'status',
    ];



}
