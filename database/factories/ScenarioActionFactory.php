<?php

use App\Entities\DeviceProperty;
use App\Entities\Scenario;
use App\Entities\ScenarioAction;
use Faker\Generator as Faker;

$factory->define(ScenarioAction::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->paragraph,
        'device_property_id' => function () {
            return factory(DeviceProperty::class)->create()->id;
        },
        'action' => json_encode([
            'command' => 'hello:world'
        ])
    ];
});
