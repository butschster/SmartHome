<?php

use SmartHome\Domain\Devices\Entities\Device;
use SmartHome\Domain\Devices\Entities\DeviceLog;
use Faker\Generator as Faker;

$factory->define(DeviceLog::class, function (Faker $faker) {
    return [
        'message' => $faker->text,
        'device_id' => function () {
            return factory(Device::class)->create()->id;
        }
    ];
});
