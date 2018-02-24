<?php

namespace SmartHome\Domain\Scenario\Triggers;

use SmartHome\Domain\Scenario\Triggers\Rule as RuleContract;
use SmartHome\Domain\Scenario\Contracts\RulesCollection as RulesCollectionContract;
use SmartHome\Domain\Scenario\Contracts\Deserializer;
use SmartHome\Exceptions\Scenario\JsonDeserializerInvalidJsonException;

class JsonDeserializer implements Deserializer
{
    /**
     * @param string $string
     *
     * @return RulesCollectionContract
     * @throws JsonDeserializerInvalidJsonException
     */
    public function deserialize(string $string): RulesCollectionContract
    {
        $data = json_decode($string, true);

        if (is_null($data) || !is_array($data)) {
            throw new JsonDeserializerInvalidJsonException();
        }

        return $this->buildRulesCollection($data);
    }

    /**
     * @param array $data
     *
     * @return RulesCollectionContract
     */
    private function buildRulesCollection(array $data): RulesCollectionContract
    {
        $rules = new RulesCollection();

        foreach ($data['rules'] as $rule) {
            $rules->push(
                $this->makeRule($rule)
            );
        }

        return $rules;
    }

    /**
     * @param array $rule
     * @return RuleContract
     */
    protected function makeRule(array $rule): RuleContract
    {
        return new Rule($rule);
    }
}