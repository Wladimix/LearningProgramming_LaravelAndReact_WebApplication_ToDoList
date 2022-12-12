<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Route::get('/tasks/{userId}', [TaskController::class, 'getTasks']);
Route::post('/addTask', [TaskController::class, 'addTask']);
Route::put('/updateTask/{taskId}', [TaskController::class, 'updateTask']);
Route::delete('/deleteTask/{taskId}', [TaskController::class, 'deleteTask']);
