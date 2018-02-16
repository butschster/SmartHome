<?php

namespace App\Scenario\Triggers\Conditions;

use App\Contracts\Scenario\Triggers\Condition;
use App\Contracts\Scenario\Triggers\Rule;
use App\Entities\DeviceProperty;

class Contains implements Condition
{
    public function check(Rule $rule, DeviceProperty $property): bool
    {
        return strpos($property->value, $rule->value()) !== false;
    }
}