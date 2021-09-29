<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;

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
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::any('/register', function() {
    return  abort(401, 'only google login');
});

Route::get('/privileges', [App\Http\Controllers\PrivilegeController::class, 'index'])->name('privileges');
Route::get('/guests', [App\Http\Controllers\GuestController::class, 'index'])->name('guests');
Route::get('/tags', [App\Http\Controllers\TagController::class, 'index'])->name('tags');
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
Route::get('/import', [App\Http\Controllers\GuestController::class, 'import_page'])->name('import');
Route::get('/export', [App\Http\Controllers\GuestController::class, 'export_page'])->name('export');
Route::post('/import_guests', [App\Http\Controllers\GuestController::class, 'import_guests'])->name('import_guests');
Route::post('/update_guest', [App\Http\Controllers\GuestController::class, 'update_guest'])->name('update_guest');
Route::post('delete/guest/{id}', [App\Http\Controllers\GuestController::class, 'delete_guest'])->name('delete_guest');
Route::post('buy/ticket/{id}', [App\Http\Controllers\GuestController::class, 'buy_ticket'])->name('buy_ticket');
Route::post('delete/ticket/{id}', [App\Http\Controllers\GuestController::class, 'delete_ticket'])->name('delete_ticket');
Route::post('/update_tag', [App\Http\Controllers\TagController::class, 'update_tag'])->name('update_tag');
Route::post('delete/tag/{id}', [App\Http\Controllers\TagController::class, 'delete_tag'])->name('delete_tag');
Route::post('/add_tag', [App\Http\Controllers\TagController::class, 'add_tag'])->name('add_tag');
Route::post('/add_guest', [App\Http\Controllers\GuestController::class, 'add_guest'])->name('add_guest');
Route::get('/gates', [App\Http\Controllers\GuestController::class, 'gates'])->name('gates');
Route::post('/update_user', [App\Http\Controllers\UserController::class, 'update_user'])->name('update_user');
Route::post('delete/user/{id}', [App\Http\Controllers\UserController::class, 'delete_user'])->name('delete_user');
Route::post('kick/guest/{id}', [App\Http\Controllers\GuestController::class, 'kick_guest'])->name('kick_guest');
Route::post('enter/guest/{id}', [App\Http\Controllers\GuestController::class, 'enter_guest'])->name('enter_ticket');
Route::post('one/user/{id}', [App\Http\Controllers\UserController::class, 'one_user'])->name('one_user');
Route::post('two/user/{id}', [App\Http\Controllers\UserController::class, 'two_user'])->name('two_user');
Route::post('three/user/{id}', [App\Http\Controllers\UserController::class, 'three_user'])->name('three_user');
Route::get('guest_tag/{tag}', [App\Http\Controllers\GuestController::class, 'guest_tag'])->name('guest_tag');
