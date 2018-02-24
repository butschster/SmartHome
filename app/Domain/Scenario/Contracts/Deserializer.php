<?php

namespace SmartHome\Domain\Scenario\Contracts;

use SmartHome\Domain\Scenario\Contracts\Triggers\Rule;

interface Deserializer
{
    /**
     * @param string $string
     *
     * @return RulesCollection|Rule[]
     */
    public function deserialize(string $string): RulesCollection;
}