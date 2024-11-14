<?php

use App\Http\Controllers\Crud\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('users', UserController::class);
