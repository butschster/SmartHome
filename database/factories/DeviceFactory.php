<?php

use App\Entities\Device;
use App\Mqtt\DeviceManager;
use Faker\Generator as Faker;

$factory->define(Device::class, function (Faker $faker) {
    $types = array_keys((new DeviceManager(app()))->getDrivers());

    return [
        'key' => $faker->uuid,
        'source' => \App\Contracts\Device::SOURCE_MQTT,
        'type' => $faker->randomElement($types)
    ];
});
