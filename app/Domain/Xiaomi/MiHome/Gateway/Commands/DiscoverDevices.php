<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Gateway\Commands;

use SmartHome\Domain\Xiaomi\Contracts\Mihome\Gateway\Command;

class DiscoverDevices implements Command
{

    public function command(): array
    {
        return [
            'cmd' => 'get_id_list'
        ];
    }
}