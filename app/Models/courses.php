<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class courses extends Model
{
    protected $table='courses';

    protected $fillable = [
        'name',
    ];

    public function  Users(){
        return $this->belongsToMany('App\Models\User','studens_courses')->withTimestamps();
    }
}
