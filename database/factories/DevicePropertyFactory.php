<?php

use App\Entities\Device;
use App\Entities\DeviceProperty;
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
