<?php

use App\Entities\Scenario;
use Faker\Generator as Faker;

$factory->define(Scenario::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->paragraph,
        'priority' => $faker->randomNumber(),
        'cron_expression' => '* * * * *'
    ];
});
