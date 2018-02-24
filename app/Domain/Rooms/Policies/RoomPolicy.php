<?php

namespace SmartHome\Domain\Rooms\Policies;

use SmartHome\Domain\Rooms\Entities\Room;
use SmartHome\Domain\Users\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoomPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Room $room
     * @return bool
     */
    public function update(User $user, Room $room): bool
    {
        return true;
    }

    /**
     * @param User $user
     * @param Room $room
     * @return bool
     */
    public function store(User $user, Room $room): bool
    {
        return true;
    }

    /**
     * @param User $user
     * @param Room $room
     * @return bool
     */
    public function destroy(User $user, Room $room): bool
    {
        return true;
    }
}
