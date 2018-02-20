<?php

namespace App\Providers;

use App\Entities\Device;
use App\Entities\DeviceProperty;
use App\Entities\Weather;
use App\Observers\DevicePropertyChangedObserver;
use App\Observers\NewDeviceRegisteredObserver;
use App\Observers\WeatherChangedObserver;
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
        \App\Events\DeviceRegistered::class => [
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
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        DeviceProperty::observe(DevicePropertyChangedObserver::class);
        Device::observe(NewDeviceRegisteredObserver::class);
        Weather::observe(WeatherChangedObserver::class);
    }
}
