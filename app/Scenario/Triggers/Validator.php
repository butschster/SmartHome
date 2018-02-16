<?php

namespace App\Scenario\Triggers;

use App\Contracts\Scenario\Triggers\Rule as RuleContract;
use App\Contracts\Scenario\Triggers\Validator as ValidatorContract;
use App\Entities\DeviceProperty;

class Validator implements ValidatorContract
{
    /**
     * @var string
     */
    private $json;

    /**
     * @param string $json
     */
    public function __construct(string $json)
    {
        $this->json = $json;
    }

    /**
     * @param DeviceProperty $property
     * @return bool
     * @throws \App\Exceptions\Scenario\ConditionNotfoundException
     */
    public function validate(DeviceProperty $property): bool
    {
        /** @var RuleContract[] $rules */
        $rules = collect($this->decodeJson())->map(function (array $rule) {
            return $this->makeRule($rule);
        });

        foreach ($rules as $rule) {
            if (!$this->validateRule($rule, $property)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return array
     */
    protected function decodeJson(): array
    {
        $data = json_decode($this->json, true);

        return (array)array_get($data, 'rules');
    }

    /**
     * @param array $rule
     * @return RuleContract
     */
    protected function makeRule(array $rule): RuleContract
    {
        return new Rule($rule);
    }

    /**
     * @param RuleContract $rule
     * @param DeviceProperty $property
     * @return bool
     * @throws \App\Exceptions\Scenario\ConditionNotfoundException
     */
    protected function validateRule(RuleContract $rule, DeviceProperty $property): bool
    {
        return $rule->validate($property);
    }
}