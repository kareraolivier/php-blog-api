<?php

use App\Models\Blogs;
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

Route::get('/blogs', fn () => Blogs::all());
Route::post('/blogs', fn () => Blogs::create(["title" => "the blog", "image" => "no image", "description" => "My first blogs in php", "is_published" => true]));

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
