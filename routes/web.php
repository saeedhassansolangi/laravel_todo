<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Todo;

// ---------- Routes with Ajax Request ------------------------------------
Route::get('/', [Todo::class, 'showHomePage']);
Route::get('/getAllTodos', [Todo::class, 'getAllTodos'])->name('list_todos');
Route::get('/todos/{id}', [Todo::class, 'getSingleTodo'])->name('get_single_todo');
Route::post('/todos', [Todo::class, 'createTodo'])->name('add_single_todo');
Route::get('/todos/delete/{id}', [Todo::class, 'deleteTodo'])->name('delete_single_todo');
Route::post('/todos/edit/', [Todo::class, 'editTodo'])->name('edit_single_todo');

// ------------ Routes without Ajax ---------------------------------------
// Route::get('/', [Todo::class, 'showTodos']);
// Route::get('/todo-form', [Todo::class, 'showForm']);
// Route::get('/todos/delete/{id}', [Todo::class, 'todoDelete']);
// Route::post('/todos/update_status/', [Todo::class, 'updateStatus']);
// Route::put('todos/{id}', 'TodoController@update');
// Route::post('/todos/edit/', [Todo::class, 'todoUpdate']);
// Route::get('/todos/{id}', [Todo::class, 'todoShowUpdateForm']);
// Route::post('/todos', [Todo::class, 'addTodo']);

// ---------- for learning purposes ------------------------
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return 'test get req';
// });

// Route::post('/test', function() {
//     return 'test post req';
// });

// Route::put('/test', function() {
//     return 'test put req';
// });

// Route::patch('/test', function() {
//     return 'test patch req';
// });

// Route::delete('/test', function() {
//     return 'test delete req';
// });


// Route::view('/home', 'name');  
// Route::view('/home', 'name', ['name' => 'Taylor']);


// Route::get('/user/{userId}', function (string $id) {
//     return $id;
// });



// Route::get('/user/{userId}/{userName}', function (string $id, string $name) {
//     return $id . ' ' . $name;
// });
