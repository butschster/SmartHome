<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Devices\Listeners;

use SmartHome\Domain\Xiaomi\MiHome\Devices\Events\NoMotions;
use SmartHome\Domain\Xiaomi\MiHome\Devices\Properties\Motion;

class SetMotionToNoMotion
{
    /**
     * @param NoMotions $detected
     */
    public function handle(NoMotions $detected)
    {
        if ($detected->property->value > 0) {
            $detected->property->device->setProperties([
                'status' => Motion::STATUS_NO_MOTION
            ]);
        }
    }
}