<?php

namespace Tests\Helpers;

use App\Entities\Room;

trait RommTrait
{
    /**
     * Create a new room object
     *
     * @param array $attributes
     * @param int $times
     * @return Room
     */
    public function createRoom(array $attributes = [], int $times = null)
    {
        return factory(Room::class, $times)->create($attributes);
    }
}