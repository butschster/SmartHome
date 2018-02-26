<?php

namespace SmartHome\Domain\Sonoff\Providers;

use Illuminate\Support\ServiceProvider;
use SmartHome\App\Contracts\DeviceManager;
use SmartHome\Domain\Sonoff\Devices;

use SmartHome\Domain\Sonoff\Devices\{
    BasicRelay,
    DualRelay
};

class SonoffServiceProvider extends ServiceProvider
{
    /**
     * @param DeviceManager $manager
     */
    public function boot(DeviceManager $manager)
    {
        $manager->register(Devices::TYPE_SONOFF_BASIC, [
            'name' => 'Sonoff Basic',
            'class' => BasicRelay::class,
        ]);

        $manager->register(Devices::TYPE_SONOFF_DUAL, [
            'name' => 'Sonoff Basic',
            'class' => DualRelay::class,
        ]);
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
