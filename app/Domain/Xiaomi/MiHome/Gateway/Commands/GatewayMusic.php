<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Gateway\Commands;

use SmartHome\Domain\Xiaomi\Contracts\Mihome\Gateway\Command;

class GatewayMusic implements Command
{
    /**
     * Номер файла
     *
     * @var int
     */
    private $number;

    /**
     * @param int $number
     */
    public function __construct(int $number)
    {
        $this->number = $number;
    }

    public function command(): array
    {
        return [
            'mid' => $this->number
        ];
    }
}