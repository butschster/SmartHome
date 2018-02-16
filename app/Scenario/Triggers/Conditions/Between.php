<?php

namespace App\Scenario\Triggers\Conditions;

use App\Contracts\Scenario\Triggers\Condition;
use App\Contracts\Scenario\Triggers\Rule;
use App\Entities\DeviceProperty;

class Between implements Condition
{
    public function check(Rule $rule, DeviceProperty $property): bool
    {
        list($start, $end) = $this->parseRuleValue($rule->value());

        $value = $property->value;

        return ($value > $start and $value < $end);
    }

    /**
     * @param string $value
     * @return array
     */
    private function parseRuleValue(string $value): array
    {
        return explode(';', $value, 2);
    }
}