<?php

use App\Http\Controllers\Account\IndexController;
use App\Http\Controllers\Crud\GoalController;
use App\Http\Controllers\Crud\ProjectController;
use App\Http\Controllers\Crud\StepController;
use App\Http\Controllers\Crud\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/account', IndexController::class)->name('account');
    // Админка
    Route::middleware('has_admin')->prefix('admin')->group(function () {
       Route::resource('/users', UserController::class);
       Route::resource('/projects', ProjectController::class);
       Route::resource('/goals', GoalController::class);
       Route::resource('/steps', StepController::class);
    });
});

