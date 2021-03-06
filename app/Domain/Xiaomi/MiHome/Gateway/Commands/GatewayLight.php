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
        $this->rgb = starts_with($rgb , '#') ? substr($rgb, 1) : $rgb;
        $this->illumination = $illumination;
    }

    public function command(): array
    {
        $rgb = $this->calculateRGB();

        return [
            'rgb' => $rgb,
            'illumination' => $this->illumination
        ];
    }

    /**
     * @return float|int
     */
    protected function calculateRGB()
    {
        return $this->rgb == '000000' ? 0 : hexdec('ff' . $this->rgb);
    }
}