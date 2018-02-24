<?php

use Faker\Generator as Faker;
use SmartHome\Domain\Devices\Entities\DeviceProperty;
use SmartHome\Domain\Scenario\Entities\ScenarioAction;

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
