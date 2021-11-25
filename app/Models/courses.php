<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $table='courses';

    protected $fillable = [
        'name',
    ];

    public function  users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
