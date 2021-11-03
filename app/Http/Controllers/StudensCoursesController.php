<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\studensCourses;
use App\Models\User;

class StudensCoursesController extends Controller {
    public function index(){
        $users = User::with('courses')->where('rol', 'Estudiante')->get();
        // $users = $user->courses;
        return response()->json(['status' => 200, 'response' => $users]);
    }

    public function store(Request $request){
        // Aqui haces la funcion store commun y corriente apuntado al modelo studensCourses
        $rules = [
            'course_id' => 'required',
            'user_id' => 'required',

        ];
        $messages = [
            'course_id.required' => 'course_id is required to store!',
            'user_id.required' => 'user_id is required to store!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'status' => 201,
                'response' => $errors,
            ]);
        } else {
            $course = new studensCourses;
            $course->create($request->all());
            return response()->json(['status' => 200, 'response' => true]);
        }
    }
}
