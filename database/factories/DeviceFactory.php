<?php

use SmartHome\Domain\Devices\Entities\Device;
use Faker\Generator as Faker;

$factory->define(Device::class, function (Faker $faker) {
    return [
        'key' => $faker->word,
        'type' => 'test_device',
        'name' => $faker->sentence,
        'description' => $faker->paragraph,
        'last_activity' => $faker->dateTime
    ];
});
