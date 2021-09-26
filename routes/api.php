<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/return_suprach/{suprach_id}/{grader_id}/{graded_id}', [App\Http\Controllers\SuprachController::class, 'return_suprach']);
Route::get('/add_suprach/{suprach_id}/{user_id}/{number}', [App\Http\Controllers\SuprachController::class, 'add_suprach']);

Route::get('/add_user_activity/{activity_id}/{user_email}/{hours}', [App\Http\Controllers\AktivnostiController::class, 'add_user_activity']);
Route::get('/remove_user_activity/{activity_id}/{user_email}', [App\Http\Controllers\AktivnostiController::class, 'remove_user_activity']);

Route::get('/add_simple_user_activity/{activity_id}/{user_email}', [App\Http\Controllers\AktivnostiController::class, 'add_simple_user_activity']);
Route::get('/remove_simple_user_activity/{activity_id}/{user_email}', [App\Http\Controllers\AktivnostiController::class, 'remove_simple_user_activity']);

Route::get('/add_user_team/{user_email}/{team_id}/{role_id}', [App\Http\Controllers\TeamController::class, 'add_user_team']);
Route::get('/remove_user_team/{user_email}/{team_id}/{role_id}', [App\Http\Controllers\TeamController::class, 'remove_user_team']);
