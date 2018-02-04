<?php

namespace App\Policies;

use App\Entities\Room;
use App\Entities\User;
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
