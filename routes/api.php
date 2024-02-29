<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


//On this route you can access all child routes of blogs
Route::resource('blogs', BlogController::class);

//On this route you can access all child routes of users
Route::resource('users', AuthController::class);
Route::post('/register', [AuthController::class, 'register']);

//search 
//we added this : "middleware('auth:sanctum')"  to protect the route
Route::middleware('auth:sanctum')->get('/blogs/search/{title}', [BlogController::class, 'search']);


//This is how you add group of protected route

// Route::group(['middleware' => ['auth:sanctum']], function () {
//    Route you want to protect goes here ....... ex: Route::get('/blogs/search/{title}', [BlogController::class, 'search']);
// });

// Route::get('/blogs', [BlogController::class, 'index']);
// Route::post('/blogs', [BlogController::class, 'store']);
// Route::post('/blogs/:$id', [BlogController::class, 'show']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
