<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\studensCourses;
use App\Models\User;

class StudensCoursesController extends Controller
{
    public function index(){

        $users = User::find(4)->courses();
        // $users = $user->courses;
        return response()->json(['status' => 200, 'response' => $users]);

    }
}
