<?php

namespace SmartHome\Domain\Scenario\Triggers\Conditions;

use SmartHome\Domain\Scenario\Contracts\Triggers\Rule;
use SmartHome\Domain\Scenario\Contracts\Triggers\Value;

class NotEndsWith extends EndsWith
{
    public function check(Rule $rule, Value $value): bool
    {
        return ! parent::check($rule, $value);
    }
}