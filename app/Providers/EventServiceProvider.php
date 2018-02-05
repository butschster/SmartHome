<?php

namespace App\Providers;

use App\Entities\Device;
use App\Entities\DeviceProperty;
use App\Observers\DevicePropertyChangedObserver;
use App\Observers\NewDeviceRegisteredObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\DevicePropertyChanged::class => [

        ],
        \App\Events\DeviceRegistered::class => [
            \App\Listeners\NotifyAboutNewDevice::class
        ],
        \App\Events\DevicePing::class => [
            \App\Listeners\UpdateLastDeviceActivity::class
        ],
        \App\Events\SpechCommandHandleError::class => [
            \App\Listeners\NotifyAboutSpechCommandNotFound::class
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
    }
}
