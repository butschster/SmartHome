<?php

namespace SmartHome\Domain\Scenario\Triggers\Conditions;

use SmartHome\Domain\Scenario\Contracts\Triggers\Condition;
use SmartHome\Domain\Scenario\Contracts\Triggers\Rule;
use SmartHome\Domain\Scenario\Contracts\Triggers\Value;

class Between implements Condition
{
    public function check(Rule $rule, Value $value): bool
    {
        list($start, $end) = $this->parseRuleValue($rule->value());

        return ($value->value() > $start and $value->value() < $end);
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