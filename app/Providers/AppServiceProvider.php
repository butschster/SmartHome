<?php

namespace App\Providers;

use App\Voice\Commands\Manager;
use Illuminate\Support\ServiceProvider;

use App\Contracts\Voice\Manager as ManagerContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(ManagerContract::class, function ($app) {
            $manager = new Manager(
                $this->app,
                $this->app->make(\Illuminate\Contracts\Events\Dispatcher::class),
                $this->app->make(\Psr\Log\LoggerInterface::class)
            );

            $manager->setCommands(config('commands', []));

            return $manager;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
