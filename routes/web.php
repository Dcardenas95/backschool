<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/auth', [UserController::class, 'auth']);

Route::resource('users', UsersController::class)->only([
    'index',
]);

Route::resource('courses', CoursesController::class)->only([
    'index', 'create', 'store', 'update', 'destroy'
]);

Route::resource('notes', NotesController::class)->only([
    'index', 'create', 'store', 'update', 'destroy'
]);