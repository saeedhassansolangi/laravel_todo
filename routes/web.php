<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Todo;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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


Route::get('/', [Todo::class, 'showTodos']);
Route::get('/list_todos', [Todo::class, 'showTodo1s'])->name('list_todos');
Route::get('/todo-form', [Todo::class, 'showForm']);
// Route::post('/todos', [Todo::class, 'addTodo']);
Route::post('/todos', [Todo::class, 'addSingleTodo'])->name('add_single_todo');
// Route::get('/todos/{id}', [Todo::class, 'todoShowUpdateForm']);
Route::get('/todos/{id}', [Todo::class, 'getSingleTodo'])->name('get_single_todo');
// Route::get('/todos/delete/{id}', [Todo::class, 'todoDelete']);
Route::get('/todos/delete/{id}', [Todo::class, 'todoSingleDelete'])->name('delete_single_todo');
// Route::post('/todos/edit/', [Todo::class, 'todoUpdate']);
Route::post('/todos/edit/', [Todo::class, 'updateSingleTodo'])->name('edit_single_todo');
// Route::post('/todos/update_status/', [Todo::class, 'updateStatus']);
// Route::put('todos/{id}', 'TodoController@update');