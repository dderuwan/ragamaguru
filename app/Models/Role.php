<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected $fillable = [
        'name',
        'guard_name',
    ];

    /**
     * Define timestamps as true, since your roles table includes
     * created_at and updated_at fields.
     */
    public $timestamps = true;

    /**
     * Optionally, you can define any additional methods or relationships
     * in this model if you want to extend its functionality.
     */
}
