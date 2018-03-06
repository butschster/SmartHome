<?php

namespace SmartHome\Domain\Devices\Filters\DevicePropertyLog;

use SmartHome\App\Filters\Filters as FiltersContract;

class Filters extends FiltersContract
{
    /**
     * @var array
     */
    protected $filters = [
        'period' => PeriodFilter::class
    ];
}