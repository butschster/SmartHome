<?php

namespace App\Scenario\Triggers\Conditions;

use App\Contracts\Scenario\Triggers\Condition;
use App\Contracts\Scenario\Triggers\Rule;
use App\Entities\DeviceProperty;

class IsNull implements Condition
{
    public function check(Rule $rule, DeviceProperty $property): bool
    {
        return is_null($property->value);
    }
}