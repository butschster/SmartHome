<?php

namespace App\Contracts\Scenario\Triggers;

use App\Entities\DeviceProperty;
use App\Exceptions\Scenario\ConditionNotfoundException;

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
     * @param DeviceProperty $property
     * @return bool
     * @throws ConditionNotfoundException
     */
    public function validate(DeviceProperty $property): bool;
}