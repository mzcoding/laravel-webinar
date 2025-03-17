<?php

declare(strict_types=1);

namespace App\Providers;

use App\Events\CreatedGoal;
use App\Events\SocialUserEvent;
use App\Listeners\SendEmailListener;
use App\Listeners\SendGeneratedPasswordListener;
use App\Listeners\SyncNetworksTableListener;
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
use App\Services\Cache\CacheInterface;
use App\Services\Cache\CacheService;
use App\Services\FileUpload;
use App\Services\Output\RabbitMqService;
use App\Services\SocialUser;
use App\Services\SocialUserInterface;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Event;
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

        $this->app->bind(SocialUserInterface::class, fn() => new SocialUser(
            $this->app->make(AuthFactory::class)
        ));

        $this->app->bind(CacheInterface::class, fn() => new CacheService(
            $this->app->make('cache'),
            config('cache.default')
        ));

        $this->app->bind(FileUpload::class, fn() => new FileUpload());
        $this->app->bind(RabbitMqService::class, fn() => new RabbitMqService(
            config('rabbitmq.host'),
            (int) config('rabbitmq.port'),
            config('rabbitmq.user'),
            config('rabbitmq.password'),
        ));
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

        Event::listen([
            CreatedGoal::class => SendEmailListener::class,
        ]);

        Event::listen(SocialUserEvent::class, [
             SendGeneratedPasswordListener::class,
             SyncNetworksTableListener::class,
        ]);

        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('github', \SocialiteProviders\GitHub\Provider::class);
        });

        JsonResource::withoutWrapping();
    }
}
