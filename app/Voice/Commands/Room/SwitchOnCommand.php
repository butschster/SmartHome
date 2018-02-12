<?php

namespace App\Voice\Commands\Room;

use App\Entities\Room;
use App\Exceptions\SayableException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SwitchOnCommand
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

        $room->runCommand('switchOn');
    }
}