<?php

use Faker\Generator as Faker;
use SmartHome\Domain\Rooms\Entities\Room;

$factory->define(Room::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->paragraph,
        'position' => $faker->randomNumber()
    ];
});
