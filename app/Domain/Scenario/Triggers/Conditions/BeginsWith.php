<?php

namespace SmartHome\Domain\Scenario\Triggers\Conditions;

use SmartHome\Domain\Scenario\Contracts\Triggers\Condition;
use SmartHome\Domain\Scenario\Contracts\Triggers\Rule;
use SmartHome\Domain\Scenario\Contracts\Triggers\Value;

class BeginsWith implements Condition
{
    /**
     * @param Rule $rule
     * @param Value $value
     * @return bool
     */
    public function check(Rule $rule, Value $value): bool
    {
        return strrpos($value->value(), $rule->value(), -strlen($value->value())) !== false;
    }
}