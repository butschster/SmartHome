<?php

namespace SmartHome\App\Providers;

use SmartHome\Domain\Bot\CommandManager;
use Illuminate\Support\ServiceProvider;

use SmartHome\Domain\Bot\Contracts\Manager as ManagerContract;

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
            $manager = new CommandManager(
                $this->app,
                $this->app->make(\Illuminate\Contracts\Events\Dispatcher::class),
                $this->app->make(\Psr\Log\LoggerInterface::class)
            );

            $manager->setCommands(config('bot_commands', []));

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
