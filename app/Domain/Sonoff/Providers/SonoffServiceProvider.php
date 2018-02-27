<?php

namespace SmartHome\Domain\Sonoff\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use SmartHome\App\Contracts\DeviceManager;
use SmartHome\Domain\Sonoff\Devices;

use SmartHome\Domain\Sonoff\Devices\{
    BasicRelay,
    DualRelay
};

class SonoffServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $manager = $this->app[DeviceManager::class];

        $manager->register(Devices::TYPE_SONOFF_BASIC, BasicRelay::class);
        $manager->register(Devices::TYPE_SONOFF_DUAL, DualRelay::class);

        parent::boot();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
