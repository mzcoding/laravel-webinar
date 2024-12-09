<?php

use App\Http\Controllers\Crud\ProjectController;
use App\Http\Controllers\Crud\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Админка
Route::resource('/users', UserController::class);
Route::resource('/projects', ProjectController::class);
   // ->middleware(HasAdminMiddleware::class);
