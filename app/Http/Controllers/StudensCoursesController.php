<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\studensCourses;
use App\Models\User;

class StudensCoursesController extends Controller
{
    public function index(){

        $users = User::with('courses')->where('rol', 'Estudiante')->get();
        // $users = $user->courses;
        return response()->json(['status' => 200, 'response' => $users]);

    }
}
