<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studensCourses extends Model
{
    use HasFactory;

    public function  users(){
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }

    public function  courses(){
        return $this->belongsToMany('App\Models\courses')->withTimestamps();
    }
    
}
