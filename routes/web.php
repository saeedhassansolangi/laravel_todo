<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Todo;

Route::get('/', [Todo::class, 'showTodos']);
Route::get('/todo-form', [Todo::class, 'showForm']);
Route::get('/todos/delete/{id}', [Todo::class, 'todoDelete']);
Route::post('/todos/update_status/', [Todo::class, 'updateStatus']);
Route::put('todos/{id}', 'TodoController@update');
Route::post('/todos/edit/', [Todo::class, 'todoUpdate']);
Route::get('/todos/{id}', [Todo::class, 'todoShowUpdateForm']);
Route::post('/todos', [Todo::class, 'addTodo']);