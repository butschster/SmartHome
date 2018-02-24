<?php

namespace SmartHome\Domain\Scenario\Triggers;

use SmartHome\Domain\Scenario\Contracts\Deserializer;
use SmartHome\Domain\Scenario\Contracts\Triggers\Validator as ValidatorContract;

class Validator implements ValidatorContract
{
    /**
     * @var Deserializer
     */
    private $deserializer;

    /**
     * @param Deserializer $deserializer
     */
    public function __construct(Deserializer $deserializer)
    {
        $this->deserializer = $deserializer;
    }

    /**
     * @param string $query
     * @return bool
     * @throws \SmartHome\Domain\Scenario\Exceptions\ConditionNotfoundException
     */
    public function validate(string $query): bool
    {
        $rules = $this->deserializer->deserialize($query);

        foreach ($rules as $rule) {
            if (! $rule->validate()) {
                return false;
            }
        }

        return true;
    }
}