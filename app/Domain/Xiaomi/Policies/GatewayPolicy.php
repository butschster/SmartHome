<?php

namespace SmartHome\Domain\Xiaomi\Policies;

use SmartHome\Domain\Users\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use SmartHome\Domain\Xiaomi\Entities\Gateway;

class GatewayPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Gateway $gateway
     * @return bool
     */
    public function update(User $user, Gateway $gateway): bool
    {
        return true;
    }

    /**
     * @param User $user
     * @param Gateway $gateway
     * @return bool
     */
    public function destroy(User $user, Gateway $gateway): bool
    {
        return true;
    }
}
