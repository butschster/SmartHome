<?php

namespace App\Scenario\Triggers\Conditions;

use App\Contracts\Scenario\Triggers\Condition;
use App\Contracts\Scenario\Triggers\Rule;
use App\Entities\DeviceProperty;

class GreaterOrEqual implements Condition
{

    public function check(Rule $rule, DeviceProperty $property): bool
    {
        return $property->value >= $rule->value();
    }
}