<?php

namespace App\Mqtt\Devices\Properties;

use App\Contracts\Switchable;
use App\Mqtt\Devices\Property;

class Power extends Property implements Switchable
{
    /**
     * @var array
     */
    protected $commands = [
        'switchOn',
        'switchOff',
        'toggle'
    ];

    /**
     * Преобразование значения к нужному виду
     *
     * @param string $value
     * @return int
     */
    public function transform($value): int
    {
        switch (strtolower($value)) {
            case 'on':
                return 1;
            case 'off':
                return 0;
        }

        return $value == 1 ?: 0;
    }

    public function switchOn(): void
    {
        $this->runCommand(1);
        $this->log(__METHOD__);
    }

    public function switchOff(): void
    {
        $this->runCommand(0);
        $this->log(__METHOD__);
    }

    public function toggle(): void
    {
        if ($this->deviceProperty->value == 1) {
            $this->switchOff();
        } else {
            $this->switchOn();
        }
    }
}