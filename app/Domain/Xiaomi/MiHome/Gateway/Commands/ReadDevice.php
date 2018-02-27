<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Gateway\Commands;

use SmartHome\Domain\Xiaomi\Contracts\Mihome\Gateway\Command;

class ReadDevice implements Command
{
    /**
     * Идентификатор устройства
     *
     * @var string
     */
    private $sid;

    /**
     * @param string $sid
     */
    public function __construct(string $sid)
    {
        $this->sid = $sid;
    }

    public function command(): array
    {
        return [
            'cmd' => 'read',
            'sid' => $this->sid
        ];
    }
}