<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//make routes
Route::get('/books',[BooksController::class,'index']);
Route::get('/book/{id}',[BooksController::class,'show']);
Route::post('/book',[BooksController::class,'store']);
Route::delete('/book/{id}',[BooksController::class,'destroy']);
Route::put('/book/{id}',[BooksController::class,'update']);


//routes for getting and saving student data
Route::get('/students',[StudentController::class,'index']);
Route::get('/student/{id}',[StudentController::class,'show']);
Route::post('/student',[StudentController::class,'store']);
Route::delete('/student/{id}',[StudentController::class,'destroy']);
Route::put('/student/{id}',[StudentController::class,'update']);

//middleware for creating token for log in
Route::middleware('auth:sanctum')->group(function (){
        Route::get('/users',[UserController::class,'users']);
        Route::get('/users/{id}',[UserController::class,'user']);
        Route::delete('/users/{id}',[UserController::class,'delete']);
     });

//route for logging in and getting the token
Route::post('/login',[AuthController::class,'login']);