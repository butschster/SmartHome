<?php

namespace App\Scenario\Triggers\Conditions;

use App\Contracts\Scenario\Triggers\Condition;
use App\Contracts\Scenario\Triggers\Rule;
use App\Entities\DeviceProperty;

class BeginsWith implements Condition
{
    /**
     * @param Rule $rule
     * @param DeviceProperty $property
     * @return bool
     */
    public function check(Rule $rule, DeviceProperty $property): bool
    {
        return strrpos($property->value, $rule->value(), -strlen($property->value)) !== false;
    }
}