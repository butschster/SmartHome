<?php

namespace SmartHome\Domain\Scenario\Triggers\Conditions;

use SmartHome\Domain\Scenario\Contracts\Triggers\Condition;
use SmartHome\Domain\Scenario\Contracts\Triggers\Rule;
use SmartHome\Domain\Scenario\Contracts\Triggers\Value;

class EndsWith implements Condition
{

    public function check(Rule $rule, Value $value): bool
    {
        $numChars = strlen($value->value()) - strlen($rule->value());

        return ($numChars >= 0 and strpos($value->value(), $rule->value(), $numChars) !== false);
    }
}