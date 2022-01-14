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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[App\Http\Controllers\Api\UserApiController::class,'login']);
Route::post('coin-update',[App\Http\Controllers\Api\UserApiController::class,'updateCoin']);

Route::get('question-get/{user_id}',[App\Http\Controllers\Api\QuizApiController::class,'getQuestion']);
Route::post('user-quiz-submit/{user_id}',[App\Http\Controllers\Api\QuizApiController::class,'userQuizSubmit']);
Route::get('result/{testid}/{user_id}',[App\Http\Controllers\Api\QuizApiController::class,'getResult']);
