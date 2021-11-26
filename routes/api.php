<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\StudensCoursesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth', [UsersController::class, 'auth']);

Route::apiResource('users', UsersController::class);
Route::apiResource('courses', CoursesController::class);
Route::apiResource('notes', NotesController::class);

Route::apiResource('/student/courses', StudensCoursesController::class);
Route::get('/students/all', [StudensCoursesController::class, 'onlyStudents']);
