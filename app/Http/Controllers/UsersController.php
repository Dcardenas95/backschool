<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Session;

class UsersController extends Controller
{
    public function auth(Request $request) {
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
        } else {
            return response()->json([
                'status' => 201,
                'response' => [
                    'error' => 'Email or password incorrect',
                    'user' => 'User no exist'
                ],
            ]);
        }
    }

    public function index(){
        $users = User::all();
        return response()->json(['status' => 200, 'response' =>  $users]);
    }

    public function store(Request $request){
        $rules = [
            'fullname' => 'required',
            'email' => 'required',
            'rol' => 'required',
            'avatar' => 'required|mimes:jpg,bmp,png,',
            'password' => 'required',
        ];

        $messages = [
            'fullname.required' => 'fullname is required!',
            'email.required' => 'email is required!',
            'rol.required' => 'rol is required!',
            'avatar.required' => 'avatar is required!',
            'avatar.mimes' => 'avatar format file as (jpg,bmp,png)',
            'password.required' => 'password is required!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'status' => 201,
                'response' => $errors,
            ]);
        }
        $path = Storage::putFile('avatars', $request->file('avatar'));
        $save = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'rol' => $request->rol,
            'path' => $path,
            'password' => Hash::make($request->password)
            // 'password' => bcrypt($request->password)
        ]);
        return response()->json(['status' => 200, 'response' => true]);
    }

    public function destroy($id) {
        $user = User::find($id);
        User::destroy($id);
        Storage::delete($user->path);
        return response()->json(['status' => 200, 'response' =>  true]);
    }

    public function show($id) {
        $user = User::find($id);
        return response()->json(['status' => 200, 'response' => $user]);
    }

    public function update(Request $request, $id){
        $rules = [
            'fullname' => 'required',
            'email' => 'required',
            'rol' => 'required',
            'avatar' => 'mimes:jpg,bmp,png'
        ];

        $messages = [
            'fullname.required' => 'fullname is required!',
            'email.required' => 'email is required!',
            'rol.required' => 'rol is required!',
            'avatar.mimes' => 'avatar format file as (jpg,bmp,png)'
        ];

        if($request->password) {
            array_merge($rules, [
                'password' => 'required'
            ]);
            array_merge($messages, [
                ['password.required' => 'password is required!']
            ]);
        }

        $path = '';

        if($request->avatar) {
            array_merge($rules, [
                'avatar' => 'required|mimes:jpg,bmp,png,',
            ]);
            array_merge($messages, [
                ['avatar.required' => 'avatar format file as (jpg,bmp,png)']
            ]);
            $path = Storage::putFile('avatars', $request->file('avatar'));
        }
        $validator = Validator::make($request->all(), $rules, $messages);

        return response()->json(['status' => 200, 'response' => ['id' => $id, 'request' => $request->all()]]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'status' => 201,
                'response' => $errors,
            ]);
        }
        $user = User::find($id);


        if($request->avatar) {
            $fileOld = substr($user->path, 0, 8);
            Storage::delete();
        }
        $save = $user->save([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'rol' => $request->rol,
            'password' => isset($request->password) ? Hash::make($request->password) : $user->password,
            'path' => isset($request->avatar) ? $path : $user->path,
        ]);
        return response()->json(['status' => 200, 'response' => true]);
    }
}
