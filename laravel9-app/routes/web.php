<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/home', function () {
    echo 'abcder';
});

Route::get('/user', [UserController::class, 'index']);
Route::get('/user/create', [UserController::class, 'create']);
Route::get('/user/create2', [UserController::class, 'create2']);
Route::post('/user', [UserController::class, 'insert']);
Route::post('/user2', [UserController::class, 'insert2']);
Route::get('user/{id}', [UserController::class, 'edit']);
Route::put('user/update', [UserController::class, 'insert2']);
Route::delete('user/delete/{id}', [UserController::class, 'delete']);