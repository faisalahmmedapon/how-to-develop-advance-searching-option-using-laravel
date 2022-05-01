<?php

use App\Http\Controllers\Api\Post\PostController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// user related api here
Route::post('/registration',[UserController::class,'store'])->name('store');
Route::post('/login',[UserController::class,'login'])->name('login');

Route::middleware('auth:api')->group(function () {
    Route::get('/authenticate-user',[UserController::class,'index']);
    Route::get('/logout',[UserController::class,'logout']);
    Route::post('/user-info-update',[UserController::class,'update']);
    Route::post('/update-password',[UserController::class,'updatePassword']);

});


// post related api here
Route::get('/posts',[PostController::class,'index']);
