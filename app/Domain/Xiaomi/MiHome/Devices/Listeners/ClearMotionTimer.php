<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Devices\Listeners;

use SmartHome\Domain\Xiaomi\MiHome\Devices\Events\MotionDetected;
use SmartHome\Domain\Xiaomi\MiHome\Devices\Properties\Motion;

class ClearMotionTimer
{
    /**
     * @param MotionDetected $detected
     */
    public function handle(MotionDetected $detected)
    {
        if ($detected->property->value == Motion::STATUS_MOTION) {
            $detected->property->device->setProperties([
                'no_motion' => 0
            ]);
        }
    }
}