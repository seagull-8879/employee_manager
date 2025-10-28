<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'department_id',
        'position',
        'salary',
        'join_date',
        'photo',
    ];

    protected $casts = [
        'join_date'=> 'date',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
        // each employee belongs to one department
    }
}
