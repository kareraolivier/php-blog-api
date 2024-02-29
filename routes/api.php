<?php

use App\Http\Controllers\BlogController;
use Illuminate\Http\Request;
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


//On this route you can access all child routes 
Route::resource('blogs', BlogController::class);
Route::get('/blogs/search/{title}', [BlogController::class, 'search']);

// Route::get('/blogs', [BlogController::class, 'index']);
// Route::post('/blogs', [BlogController::class, 'store']);
// Route::post('/blogs/:$id', [BlogController::class, 'show']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
