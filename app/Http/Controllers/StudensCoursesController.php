<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreStudentCourse;
use App\Models\studensCourses;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class StudensCoursesController extends Controller {

    public function index(){
        $students = User::with('courses')->where('rol','estudiante')->get();
        // $students = User::with(['courses'=> function ($query){
        //     $query->select('name');
        // }])->where('rol','estudiante')->get();

        return response()->json(['status' => 200, 'response' => $students]);
    }

    public function store(StoreStudentCourse $request){
        // Aqui haces la funcion store commun y corriente apuntado al modelo studensCourses
        $data = $request->validated();
        $user = User::find($data['user_id']);
        $user->courses()->attach($data['course_id']);

        return response()->json(['status' => 201, 'response' => true]);
    }
}
