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

Route::get('/',[App\Http\Controllers\QuizController::class,'index'])->name('index');
Route::get('/question-addedit/{id?}', [App\Http\Controllers\QuizController::class,'questionEdit'])->name('question-editadd');
Route::get('/question-delete/{id}', [App\Http\Controllers\QuizController::class,'questionDelete'])->name('question-delete');
Route::post('/question-add', [App\Http\Controllers\QuizController::class,'questionAdd'])->name('question-add');