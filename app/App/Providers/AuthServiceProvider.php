<?php

namespace SmartHome\App\Providers;

use SmartHome\Domain\Devices\Entities\Device;
use SmartHome\Domain\Devices\Policies\DevicePolicy;
use SmartHome\Domain\Rooms\Entities\Room;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use SmartHome\Domain\Rooms\Policies\RoomPolicy;
use SmartHome\Domain\Xiaomi\Entities\Gateway;
use SmartHome\Domain\Xiaomi\Policies\GatewayPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Room::class => RoomPolicy::class,
        Device::class => DevicePolicy::class,
        Gateway::class => GatewayPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
