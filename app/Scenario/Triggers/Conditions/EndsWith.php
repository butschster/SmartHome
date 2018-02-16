<?php

namespace App\Scenario\Triggers\Conditions;

use App\Contracts\Scenario\Triggers\Condition;
use App\Contracts\Scenario\Triggers\Rule;
use App\Entities\DeviceProperty;

class EndsWith implements Condition
{

    public function check(Rule $rule, DeviceProperty $property): bool
    {
        $numChars = strlen($property->value) - strlen($rule->value());

        return ($numChars >= 0 and strpos($property->value, $rule->value(), $numChars) !== false);
    }
}