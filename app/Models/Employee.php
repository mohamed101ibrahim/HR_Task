<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'name', 'email', 'phone', 'position', 'salary', 'hired_at', 'status','department_id',

    ];
    protected $dates = ['deleted_at'];
    protected $casts = [
        'hired_at' => 'datetime',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function remove():bool
    {
        return $this->delete();
    }
}