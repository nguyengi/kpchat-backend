<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatroomController;
use App\Http\Controllers\MessageController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('auth/user', [AuthController::class, 'user']);

    Route::get('chatrooms', [ChatroomController::class, 'index']);
    Route::post('chatrooms', [ChatroomController::class, 'store']);
    Route::post('chatrooms/{chatroom}/invite', [ChatroomController::class, 'invite']);

    Route::get('chatrooms/{chatroom}/messages', [MessageController::class, 'index']);
    Route::post('chatrooms/{chatroom}/messages', [MessageController::class, 'store']);
});