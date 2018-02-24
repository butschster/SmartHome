<?php

namespace SmartHome\Domain\Scenario\Contracts\Triggers;

interface Condition
{
    /**
     * @param Rule $rule
     * @param Value $value
     * @return bool
     */
    public function check(Rule $rule, Value $value): bool;
}