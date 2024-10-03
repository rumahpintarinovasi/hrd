<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 
        'photo_path', 
        'status',
        'check_in', 
        'check_out',
        'timelateness',   
        'time_shortage',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id'); 
    }
}


