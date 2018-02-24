<?php

namespace SmartHome\Domain\Scenario\Contracts\Triggers;

interface Value
{
    /**
     * @return mixed
     */
    public function value();
}