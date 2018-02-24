<?php

use Faker\Generator as Faker;
use SmartHome\Domain\Scenario\Entities\Scenario;

$factory->define(Scenario::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->paragraph,
        'priority' => $faker->randomNumber(),
        'cron_expression' => '* * * * *'
    ];
});
