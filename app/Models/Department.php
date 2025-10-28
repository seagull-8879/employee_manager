<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'description'];
    // protected fillable fields named 'name' and 'description'

    public function employees()
    {
        return $this->hasMany(Employee::class);
        // one department has many employees
    }
}
