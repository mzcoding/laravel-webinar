<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Goal;
use App\Models\Project;
use App\Models\Step;
use App\Models\User;
use App\Repository\GoalRepository;
use App\Repository\GoalRepositoryInterface;
use App\Repository\ProjectRepository;
use App\Repository\ProjectRepositoryInterface;
use App\Repository\StepRepository;
use App\Repository\StepRepositoryInterface;
use App\Repository\UserRepository;
use App\Repository\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserRepositoryInterface::class,
            fn() => new UserRepository(new User));

        $this->app->singleton(ProjectRepositoryInterface::class,
            fn() => new ProjectRepository(new Project));

        $this->app->singleton(GoalRepositoryInterface::class,
            fn() => new GoalRepository(new Goal));

        $this->app->singleton(StepRepositoryInterface::class,
            fn() => new StepRepository(new Step));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::enforceMorphMap([
            'post' => 'App\Models\Post',
            'video' => 'App\Models\Video',
        ]);
    }
}
