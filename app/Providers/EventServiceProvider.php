<?php

namespace App\Providers;

use App\Entities\Device;
use App\Entities\DeviceProperty;
use App\Entities\Weather;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\DeviceProperty\Changed::class => [
            \App\Listeners\LogDevicePropertyValues::class
        ],
        \App\Events\Device\Registered::class => [
            \App\Listeners\NotifyAboutNewDevice::class
        ],
        \App\Events\Device\Ping::class => [
            \App\Listeners\Device\UpdateLastActivity::class
        ],
        \App\Events\SpechCommandHandleError::class => [
            \App\Listeners\NotifyAboutSpechCommandNotFound::class
        ],
        \App\Events\Mqtt\Message::class => [
            \App\Listeners\Mqtt\LogMessages::class,
        ],
        \App\Events\Device\LastActivityUpdated::class => [

        ]
    ];

    /**
     * The event observers mappings for the models.
     *
     * @var array
     */
    protected $observers = [
        DeviceProperty::class => [
            \App\Observers\DevicePropertyChangedObserver::class
        ],
        Device::class => [
            \App\Observers\NewDeviceRegisteredObserver::class
        ],
        Weather::class => [
            \App\Observers\WeatherChangedObserver::class
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
