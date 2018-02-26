<?php

namespace SmartHome\Domain\Xiaomi\Providers;

use Illuminate\Support\ServiceProvider;
use SmartHome\App\Contracts\DeviceManager;
use SmartHome\Domain\Xiaomi\Devices;

use SmartHome\Domain\Xiaomi\Devices\{
    Button, Magnet, Thermometer
};

class XiaomiServiceProvider extends ServiceProvider
{
    /**
     * @param DeviceManager $manager
     */
    public function boot(DeviceManager $manager)
    {
        $manager->register(Devices::TYPE_XIAOMI_TH, [
            'name' => 'Xiaomi Mi Smart Home Temperature / Humidity Sensor',
            'class' => Thermometer::class,
        ]);

        $manager->register(Devices::TYPE_XIAOMI_MAGNET, [
            'name' => 'Xiaomi Mi Smart Home Door Sensor',
            'class' => Magnet::class,
        ]);

        $manager->register(Devices::TYPE_XIAOMI_BUTTON, [
            'name' => 'Xiaomi Mi Smart Home Button',
            'class' => Button::class,
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
