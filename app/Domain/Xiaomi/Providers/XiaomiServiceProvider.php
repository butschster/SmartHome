<?php

namespace SmartHome\Domain\Xiaomi\Providers;

use SmartHome\App\Contracts\DeviceManager;
use SmartHome\Domain\Xiaomi\Devices;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use SmartHome\Domain\Xiaomi\MiHome\Devices\{
    Button, Events\MotionDetected, Events\NoMotions, Gateway, Listeners\ClearMotionTimer, Listeners\SetMotionToNoMotion, Magnet, Motion, Thermometer
};

class XiaomiServiceProvider extends ServiceProvider
{
    protected $listen = [
        MotionDetected::class => [
            ClearMotionTimer::class
        ],
        NoMotions::class => [
            SetMotionToNoMotion::class
        ]
    ];

    public function boot()
    {
        $manager = $this->app[DeviceManager::class];

        $manager->register(Devices::TYPE_XIAOMI_TH, Thermometer::class);
        $manager->register(Devices::TYPE_XIAOMI_MAGNET, Magnet::class);
        $manager->register(Devices::TYPE_XIAOMI_BUTTON, Button::class);
        $manager->register(Devices::TYPE_XIAOMI_MOTION, Motion::class);
        $manager->register(Devices::TYPE_XIAOMI_GATEWAY, Gateway::class);

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
