<?php

namespace SmartHome\App\Providers;

use Illuminate\Support\ServiceProvider;
use SmartHome\App\Devices\DeviceManager;
use SmartHome\App\Contracts\DeviceManager as DeviceManagerContract;

class DevicesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(DeviceManagerContract::class, function ($app) {
            return new DeviceManager($app);
        });
    }
}
