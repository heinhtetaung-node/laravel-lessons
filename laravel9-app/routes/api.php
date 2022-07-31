<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Api\UserApiController;
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


Route::get('/test', [TestController::class, 'getDatas']);

Route::get('/user', [UserApiController::class, 'getDatas']);
Route::post('/user/add', [UserApiController::class, 'insertDatas']);
Route::put('/user/{id}', [UserApiController::class, 'insertDatas']);
Route::delete('/user/delete/{id}', [UserApiController::class, 'deleteData']);