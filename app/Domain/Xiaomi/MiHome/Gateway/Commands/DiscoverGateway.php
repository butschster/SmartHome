<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Gateway\Commands;

use SmartHome\Domain\Xiaomi\Contracts\Mihome\Gateway\Command;

class DiscoverGateway implements Command
{

    public function command(): array
    {
        return [
            'cmd' => 'whois'
        ];
    }
}