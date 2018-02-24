<?php

namespace SmartHome\Domain\Devices\Policies;

use SmartHome\Domain\Devices\Entities\Device;
use SmartHome\Domain\Users\Entities\User;
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

    /**
     * @param User $user
     * @param Device $device
     * @return bool
     */
    public function destroy(User $user, Device $device): bool
    {
        return true;
    }
}
