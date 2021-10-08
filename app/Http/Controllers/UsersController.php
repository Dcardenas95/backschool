<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;


class UsersController extends Controller
{
    //
    public function auth(Request $request)
    {
        $name = $request->email;
        $password = $request->email;

        $messages = [
            'email.required' => 'El mail es obligatorio!',
            'password.required' => 'La Contrasena es obligaria',
        ];
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        $credentials = $request->validate($request->all(), $rules, $messages);
        if ($credentials->fails()) {
            $errors = $credentials->errors();
            return response()->json([
                'status' => 201,
                'response' => $errors,
            ]);
         }
         if (Auth::attempt($credentials)) {
             //Hacemos uso del facade de auth, y generamos sesion 
            $request->session()->regenerate();
            return response()->json([
                'status' => 200,
                'response' => ['session' => Session::get('remember_token')],
            ]);
        }
    }
}
