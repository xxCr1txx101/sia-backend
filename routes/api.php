<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FriendsController;


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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware'=>'auth:api'], function(){
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/friends/search', [FriendsController::class, 'search']);
    Route::post('/friends', [FriendsController::class, 'store']);
    Route::get('/friends', [FriendsController::class, 'index']);
    Route::get('/friends/{friends}', [FriendsController::class, 'show']);
    Route::put('/friends/{friends}', [FriendsController::class, 'update']);
    Route::delete('/friends/{friends}', [FriendsController::class, 'destroy']);
});
