<?php

use App\Entities\Device;
use App\Mqtt\DeviceManager;
use Faker\Generator as Faker;

$factory->define(Device::class, function (Faker $faker) {
    $types = array_keys((new DeviceManager(app()))->getDrivers());

    return [
        'key' => $faker->uuid,
        'type' => $faker->randomElement($types)
    ];
});
