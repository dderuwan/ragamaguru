<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'emp_attendance';

    protected $fillable = [
        'emp_id',
        'date' ,
        'sign_in' ,
        'sign_out' ,
        'stayed_time' 
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'emp_id'); // Ensure 'emp_id' is the foreign key in your 'emp_attendance' table
    }


}
