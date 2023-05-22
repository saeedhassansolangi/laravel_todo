<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User as User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// http://localhost:8000/api/user
// prefix '/api' is automatically added by laravel
Route::get('/', function () {
    return 'user route';
});

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

// Route::match(['post', 'get'], '/',function() {
//     return '[get, post]';
// }); 

// app.use('*', callback)
// Route::any('/anyRouteName', cb )

// Route::post('/', function(Request $req) {
//     $name =  $req->name;;
//     return 'for all ' . $name;
// });


Route::get('/user', [User::class, 'show']);