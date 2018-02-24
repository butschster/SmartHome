<?php

namespace SmartHome\App\Providers;

use SmartHome\Domain\Devices\Entities\Device;
use SmartHome\Domain\Devices\Entities\DeviceProperty;
use SmartHome\Domain\Weather\Weather;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \SmartHome\Domain\Devices\Events\DeviceProperty\Changed::class => [
            \SmartHome\Domain\Devices\Listeners\LogDevicePropertyValues::class
        ],
        \SmartHome\Domain\Devices\Events\Device\Registered::class => [
            \SmartHome\Domain\Devices\Listeners\NotifyAboutNewDevice::class
        ],
        \SmartHome\Domain\Devices\Events\Device\Ping::class => [
            \SmartHome\Domain\Devices\Listeners\UpdateLastActivity::class
        ],
        \SmartHome\Domain\Bot\Events\HandleCommandError::class => [
            \SmartHome\Domain\Bot\Listeners\SayCommandNotFound::class
        ],
        \SmartHome\Domain\Mqtt\Events\Message::class => [
            \SmartHome\Domain\Mqtt\Listeners\LogMessages::class,
        ],
        \SmartHome\Domain\Devices\Events\Device\LastActivityUpdated::class => [

        ]
    ];

    /**
     * The event observers mappings for the models.
     *
     * @var array
     */
    protected $observers = [
        DeviceProperty::class => [
            \SmartHome\Domain\Devices\Observers\DevicePropertyChangedObserver::class
        ],
        Device::class => [
            \SmartHome\Domain\Devices\Observers\NewDeviceRegisteredObserver::class
        ],
        Weather::class => [
            \SmartHome\Domain\Weather\Observers\WeatherChangedObserver::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->registerObservers();
    }

    protected function registerObservers(): void
    {
        foreach ($this->observers as $model => $observers) {
            foreach ($observers as $observer) {
                $model::observe($observer);
            }
        }
    }
}
