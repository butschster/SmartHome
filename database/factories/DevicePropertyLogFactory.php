<?php

use SmartHome\Domain\Devices\Entities\DeviceProperty;
use SmartHome\Domain\Devices\Entities\DevicePropertyLog;
use Faker\Generator as Faker;

$factory->define(DevicePropertyLog::class, function (Faker $faker) {
    return [
        'device_property_id' => function () {
            return factory(DeviceProperty::class)->create()->id;
        },
        'value' => $faker->randomNumber()
    ];
});