<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    Use HasFactory;
    protected $fillable = [
        'name',
    ];
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}