<?php

namespace SmartHome\Domain\Scenario\Triggers\Conditions;

use SmartHome\Domain\Scenario\Contracts\Triggers\Condition;
use SmartHome\Domain\Scenario\Contracts\Triggers\Rule;
use SmartHome\Domain\Scenario\Contracts\Triggers\Value;

class Contains implements Condition
{
    public function check(Rule $rule, Value $value): bool
    {
        return strpos($value->value(), $rule->value()) !== false;
    }
}