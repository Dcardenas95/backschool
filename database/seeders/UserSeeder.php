<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'fullname' => 'david cardenas',
            'rol' => 'admin',
            'email' => 'admin@gmail.com',
            'remember_token' => Str::random(10),
            'path' => '',
            'password' => Hash::make(12345678),
        ]);
        User::create([
            'fullname' => 'sebastian guerrero',
            'rol' => 'docente',
            'email' => 'docente@gmail.com',
            'path' => '',
            'remember_token' => Str::random(10),
            'password' => Hash::make(12345678),
        ]);
        User::create([
            'fullname' => 'juliana diaz',
            'rol' => 'estudiante',
            'email' => 'estudiante@gmail.com',
            'path' => '',
            'remember_token' => Str::random(10),
            'password' => Hash::make(12345678),
        ]);
        User::create([
            'fullname' => 'jose castillo',
            'rol' => 'estudiante',
            'email' => 'estudiante2@gmail.com',
            'path' => '',
            'remember_token' => Str::random(10),
            'password' => Hash::make(12345678),
        ]);
    }
}
