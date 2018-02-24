<?php

namespace SmartHome\Domain\Scenario\Triggers;

use SmartHome\Domain\Scenario\Contracts\Triggers\Condition;
use SmartHome\Domain\Scenario\Contracts\Triggers\Rule as RuleContract;
use SmartHome\Domain\Scenario\Contracts\Triggers\Value as ValueContract;
use SmartHome\Domain\Scenario\Exceptions\ConditionNotfoundException;

class Rule implements RuleContract
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $field;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $input;

    /**
     * @var string
     */
    protected $operator;

    /**
     * @var string|array
     */
    protected $value;

    /**
     * @var array
     */
    protected $meta = [];

    /**
     * Список доступных условий
     *
     * @var array
     */
    protected $conditions = [
        Conditions\Contains::class => ['contains', '*'],
        Conditions\NotContains::class => ['not_contains', '!*'],
        Conditions\Equal::class => ['equal', '==', '==='],
        Conditions\NotEqual::class => ['equal', '!=', '!=='],
        Conditions\Less::class => ['less', 'lt', '<'],
        Conditions\LessOrEqual::class => ['less_or_equal', 'lte', '<='],
        Conditions\Greater::class => ['greater', '>', 'gt'],
        Conditions\GreaterOrEqual::class => ['greater_or_equal', '>=IsNotNull', 'gte'],
        Conditions\BeginsWith::class => ['begins', 'begins_with', '*.'],
        Conditions\NotBeginsWith::class => ['not_begins', 'not_begins_with', '!*.'],
        Conditions\EndsWith::class => ['ends', 'ends_with', '.*'],
        Conditions\NotEndsWith::class => ['not_ends', 'not_ends_with', '!.*'],
        Conditions\IsEmpty::class => ['empty', 'is_empty'],
        Conditions\IsNotEmpty::class => ['not_empty', 'is_not_empty'],
        Conditions\IsNull::class => ['null', 'nullable'],
        Conditions\IsNotNull::class => ['not_null'],
        Conditions\Between::class => ['between']
    ];

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            } else {
                $this->meta[$key] = $value;
            }
        }
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function field(): string
    {
        return $this->field;
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function input(): string
    {
        return $this->input;
    }

    /**
     * @return string
     */
    public function operator(): string
    {
        return $this->operator;
    }

    /**
     * @return ValueContract
     */
    public function value(): ValueContract
    {
        return $this->value;
    }

    /**
     * @return bool
     * @throws ConditionNotfoundException
     */
    public function validate(): bool
    {
        foreach ($this->conditions as $class => $names) {
            if (in_array($this->operator, $names)) {
                return $this->makeCondition($class)->check($this, $this->value());
            }
        }

        throw new ConditionNotfoundException(
            sprintf('Condition for operator [%s] not found', $this->operator)
        );
    }

    /**
     * @param string $class
     * @return Condition
     */
    private function makeCondition(string $class): Condition
    {
        return app()->make($class);
    }
}