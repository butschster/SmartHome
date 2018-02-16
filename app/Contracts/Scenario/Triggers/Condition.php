<?php

namespace App\Contracts\Scenario\Triggers;

use App\Entities\DeviceProperty;

interface Condition
{
    /**
     * @param Rule $rule
     * @param DeviceProperty $property
     * @return bool
     */
    public function check(Rule $rule, DeviceProperty $property): bool;
}