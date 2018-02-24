<?php

namespace SmartHome\Domain\Scenario\Contracts\Triggers;

interface Validator
{
    /**
     * @param string $query
     * @return bool
     */
    public function validate(string $query): bool;
}