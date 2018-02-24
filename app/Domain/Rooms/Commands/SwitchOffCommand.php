<?php

namespace SmartHome\Domain\Rooms\Commands;

use SmartHome\Domain\Rooms\Entities\Room;
use SmartHome\Domain\Bot\Exceptions\SayableException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SwitchOffCommand
{
    /**
     * @param string $roomName
     * @throws SayableException
     */
    public function handle(string $roomName)
    {
        try {
            $room = Room::where('name', 'like', $roomName . '%')->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new SayableException('Помещение не найдено');
        }

        $room->runCommand('switchOff');
    }
}