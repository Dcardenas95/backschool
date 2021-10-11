<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;


class UsersController extends Controller
{
    //
    public function auth(Request $request)
    {
        // $name = $request->email;
        // $password = $request->password;

        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];
        
        $messages = [
            'email.required' => 'El Email es obligatorio!',
            'password.required' => 'La Contrasena es obligaria',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'status' => 201,
                'response' => $errors,
            ]);
         }
         if (Auth::attempt($request->all())) {
             //Hacemos uso del facade de auth, y generamos sesion
             $apikey = base64_encode(\Illuminate\Support\Str::random(40));
             User::where('email', $request->email)->update(['remember_token' => $apikey]);
             $user = User::where('email', $request->email)->first();
            return response()->json(['status' => 200, 'response' =>  $user]);
        }
    }
}
