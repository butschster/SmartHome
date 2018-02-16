<?php

namespace App\Scenario\Triggers\Conditions;

use App\Contracts\Scenario\Triggers\Condition;
use App\Contracts\Scenario\Triggers\Rule;
use App\Entities\DeviceProperty;

class Equal implements Condition
{
    /**
     * @param Rule $rule
     * @param DeviceProperty $property
     * @return bool
     */
    public function check(Rule $rule, DeviceProperty $property): bool
    {
        return $rule->value() == $property->value;
    }
}