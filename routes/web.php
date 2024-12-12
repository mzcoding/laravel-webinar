<?php

use App\Http\Controllers\Crud\GoalController;
use App\Http\Controllers\Crud\ProjectController;
use App\Http\Controllers\Crud\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
   // $user = \App\Models\User::find(14);
   // dd($user->allGoals);

    $project = \App\Models\Project::find(7);
    $project->exampleGoals()->attach(7);
    foreach ($project->exampleGoals as $goal) {
        echo $goal->name .": Завершено на: " . $goal->pivot->completed_percentage . " %<br>";
    }
});

// Админка
Route::resource('/users', UserController::class);
Route::resource('/projects', ProjectController::class);
Route::resource('/goals', GoalController::class);
   // ->middleware(HasAdminMiddleware::class);
