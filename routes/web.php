<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
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

Route::get('/',[TaskController::class, 'index'])->name('index');
Route::post('/task',[TaskController::class, 'addtask'])->name('addtask');
Route::delete('/task/delete/{id}',[TaskController::class, 'delete'])->name('delete');
Route::patch('/task/update/{id}',[TaskController::class, 'update'])->name('updatetask');
