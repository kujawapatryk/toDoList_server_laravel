<?php

namespace App\Providers;

use App\Repositories\TaskRepository;
use App\Repositories\TaskRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class TaskServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
            TaskRepositoryInterface::class,
            TaskRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
