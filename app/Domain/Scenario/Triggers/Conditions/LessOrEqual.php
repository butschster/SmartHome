<?php

namespace SmartHome\Domain\Scenario\Triggers\Conditions;

use SmartHome\Domain\Scenario\Contracts\Triggers\Condition;
use SmartHome\Domain\Scenario\Contracts\Triggers\Rule;
use SmartHome\Domain\Scenario\Contracts\Triggers\Value;

class LessOrEqual implements Condition
{
    public function check(Rule $rule, Value $value): bool
    {
        return $value->value() <= $rule->value();
    }
}