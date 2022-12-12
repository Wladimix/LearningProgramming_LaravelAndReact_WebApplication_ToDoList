<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\TaskController;


Route::get('/', function () {
    return redirect('/tasks');
});

Route::get('/tasks', [TaskController::class, 'greeting'])->middleware('auth')->name('tasks');

Route::prefix('/login')->group(function() {
    Route::get('/', function() {
        if (Auth::check()) { return redirect(route('tasks')); }
        return view('auth.login');
    })->name('login');
    
    Route::post('/', [LoginController::class, 'authentication']);
});

Route::prefix('/registration')->group(function() {
    Route::get('/', function() {
        if (Auth::check()) { return redirect(route('tasks')); }
        return view('auth.registration');
    })->name('registration');
    
    Route::post('/', [RegistrationController::class, 'registration']);
});

Route::get('/logout', function() {
    Auth::logout();
    return redirect('/');
})->name('logout');
