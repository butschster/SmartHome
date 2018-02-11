<?php

namespace App\Commands\Room;

use App\Entities\Room;
use App\Exceptions\SayableException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SwitchOnCommand
{
    /**
     * @return array
     */
    public static function triggers(): array
    {
        return [
            'включи свет в *',
            'включи свет на *'
        ];
    }

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