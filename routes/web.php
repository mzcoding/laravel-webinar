<?php

use App\Http\Controllers\Crud\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function (\Illuminate\Http\Request $request) {
   return response()->download(public_path('robots.txt'));
});


Route::resource('users', UserController::class);
