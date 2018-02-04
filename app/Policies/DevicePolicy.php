<?php

namespace App\Policies;

use App\Entities\Device;
use App\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DevicePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Device $device
     * @return bool
     */
    public function update(User $user, Device $device): bool
    {
        return true;
    }
}
