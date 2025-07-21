<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'position', 'salary', 'hired_at', 'status'
    ];
}