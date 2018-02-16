<?php

namespace App\Contracts\Scenario\Triggers;

use App\Entities\DeviceProperty;

interface Validator
{
    /**
     * @param DeviceProperty $property
     * @return bool
     */
    public function validate(DeviceProperty $property): bool;
}