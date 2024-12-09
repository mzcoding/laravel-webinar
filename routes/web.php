<?php

use App\Http\Controllers\Crud\UserController;
use App\Http\Middleware\HasAdminMiddleware;
use App\Models\Goal;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function (\Illuminate\Http\Request $request) {
   $table = DB::table('projects');
   $model = Goal::query();

   dd(
       $model
       ->select(['goals.id', 'goals.name as name'])
       ->leftJoin('projects as p', 'p.id', '=', 'goals.project_id')
       ->where('goals.term_in_months', '<=', 7)
       ->whereIn('goals.id', [2,10,19])
       ->whereRaw("NOT EXISTS (SELECT 1 FROM steps where goals.id = steps.goal_id)")
       ->OrWhereDate('p.created_at', '<', now()->subMonth())
           ->orderBy('goals.id', 'desc')
           ->get()
   );
});



Route::resource('/users', UserController::class);
   // ->middleware(HasAdminMiddleware::class);
