<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Gateway\Commands;

use SmartHome\Domain\Xiaomi\Contracts\Mihome\Gateway\Command;

class GatewayLight implements Command
{
    /**
     * @var string
     */
    private $rgb;

    /**
     * @var int
     */
    private $illumination;

    /**
     * @param string $rgb
     * @param int $illumination
     */
    public function __construct(string $rgb, int $illumination)
    {
        $this->rgb = $rgb;
        $this->illumination = $illumination;
    }

    public function command(): array
    {
        return [
            'rgb' => $this->rgb,
            'illumination' => $this->illumination
        ];
    }
}