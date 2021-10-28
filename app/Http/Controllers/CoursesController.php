<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoursesController extends Controller
{
    public function index(){
        $courses = Courses::all();
        return response()->json(['status' => 200, 'response' =>  $courses]);
    }

    public function store(Request $request){
        $rules = [
            'name' => 'required',
        ];

        $messages = [
            'name.required' => 'fullname is required to store!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'status' => 201,
                'response' => $errors,
            ]);
        } else {
            $course = new Courses;
            $course->create($request->all());
            return response()->json(['status' => 200, 'response' => true]);
        }
    }

    public function show($id) {
        $course = Courses::find($id);
        return response()->json(['status' => 200, 'response' => $course]);
    }

    public function update(Request $request, $id){
        $rules = [
            'name' => 'required',
        ];

        $messages = [
            'name.required' => 'nombre requerido para actualizar!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'status' => 201,
                'response' => $errors,
            ]);

        } else {
            $course = Courses::find($id);
            $course->update($request->all());
            return response()->json(['status' => 200, 'response' => true]);
        }
    }

    public function destroy($id) {
        Courses::destroy($id);
        return response()->json(['status' => 200, 'response' =>  true]);
    }
}
