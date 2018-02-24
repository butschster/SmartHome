<?php

use Faker\Generator as Faker;
use SmartHome\Domain\Devices\Entities\DeviceProperty;
use SmartHome\Domain\Scenario\Entities\Scenario;
use SmartHome\Domain\Scenario\Entities\ScenarioTrigger;

$factory->define(ScenarioTrigger::class, function (Faker $faker) {
    $condition = $faker->randomElement(['gt', 'lt', 'gte', 'lte', 'eq', 'not_eq', 'between']);
    $value = $faker->randomNumber();
    if ($condition == 'between') {
        $value = [$value, $faker->randomNumber()];
    }

    return [
        'name' => $faker->sentence,
        'description' => $faker->paragraph,
        'scenario_id' => function () {
            return factory(Scenario::class)->create()->id;
        },
        'device_property_id' => function () {
            return factory(DeviceProperty::class)->create()->id;
        },
        'condition' => json_encode([
            'condition' => $condition,
            'value' => $value
        ])
    ];
});
