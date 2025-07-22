<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'email', 'phone', 'position', 'salary', 'hired_at', 'status'
    ];
    protected $dates = ['deleted_at'];


    public function remove():bool
    {
        return $this->delete();
    }
}