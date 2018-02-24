<?php

namespace SmartHome\Domain\Scenario\Contracts\Triggers;

use SmartHome\Domain\Scenario\Exceptions\ConditionNotfoundException;

interface Rule
{
    /**
     * @return string
     */
    public function id(): string;

    /**
     * @return string
     */
    public function field(): string;

    /**
     * @return string
     */
    public function type(): string;

    /**
     * @return string
     */
    public function input(): string;

    /**
     * @return string
     */
    public function operator(): string;

    /**
     * @return array|string
     */
    public function value();

    /**
     * @return bool
     * @throws ConditionNotfoundException
     */
    public function validate(): bool;
}