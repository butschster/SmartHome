<?php

namespace App\Scenario\Triggers\Conditions;

use App\Contracts\Scenario\Triggers\Rule;
use App\Entities\DeviceProperty;

class NotEqual extends Equal
{
    public function check(Rule $rule, DeviceProperty $property): bool
    {
        return ! parent::check($rule, $property);
    }
}