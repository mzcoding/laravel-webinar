<?php

use App\Http\Controllers\Crud\UserController;
use App\Http\Middleware\HasAdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function (\Illuminate\Http\Request $request) {
   return response()->download(public_path('robots.txt'));
});



Route::resource('{locale}/users', UserController::class);
   // ->middleware(HasAdminMiddleware::class);
