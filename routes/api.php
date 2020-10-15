<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\NoteController;
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

Route::post('login',
    [UserController::class,'login']);


Route::post('register',
    [UserController::class,'register']);

Route::middleware('auth:api')->group(function (){

    Route::get('notes',
        [NoteController::class,'all']);


    Route::post('note/create',
        [NoteController::class,'create']);

    Route::post('note/{noteId}/update',
        [NoteController::class,'update']);


    Route::get('note/{noteId}/destroy',
        [NoteController::class,'destroy']);

});
