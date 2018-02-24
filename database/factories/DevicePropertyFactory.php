<?php

use SmartHome\Domain\Devices\Entities\Device;
use SmartHome\Domain\Devices\Entities\DeviceProperty;
use Faker\Generator as Faker;

$factory->define(DeviceProperty::class, function (Faker $faker) {
    return [
        'device_id' => function () {
            return factory(Device::class)->create()->id;
        },
        'name' => $faker->sentence,
        'description' => $faker->paragraph,
        'key' => $faker->word,
        'value' => $faker->randomNumber()
    ];
});
