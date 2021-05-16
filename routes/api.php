<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoController;
use App\Http\Controllers\AuthController;

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

// public routes
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/todos/pending', [ToDoController::class, 'getAllPending']);
    Route::get('/todos/done', [ToDoController::class, 'getAllDone']);
    Route::get('/todos/{id}', [ToDoController::class, 'getOne']);
    Route::patch('/todos/finish/{id}', [ToDoController::class, 'finishToDo']);
    Route::patch('/todos/open/{id}', [ToDoController::class, 'openToDo']);
    Route::put('/todos/{id}', [ToDoController::class, 'update']);
    Route::post('/todos', [ToDoController::class, 'add']);
    Route::delete('/todos/{id}', [ToDoController::class, 'delete']);

    Route::post('logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
