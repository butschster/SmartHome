<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Devices\Properties;

use SmartHome\App\Devices\Property;
use SmartHome\Domain\Devices\Entities\DeviceProperty;
use SmartHome\Domain\Xiaomi\Entities\Gateway;
use SmartHome\Domain\Xiaomi\MiHome\Gateway\Commands\GatewayLight;

class RGB extends Property
{

    /**
     * @var array
     */
    protected $commands = [
        'changeColor',
    ];


    /**
     * Преобразование значения к нужному виду
     *
     * @param mixed $value
     * @return mixed
     */
    public function transform($value)
    {
        return $value;
    }

    /**
     * @param DeviceProperty $property
     */
    public function changeColor(DeviceProperty $property, $color): void
    {
        $gateway = Gateway::whereHas('devices', function($query) use($property) {
            $query->where('device_id', $property->device_id);
        })->first();

        xiaomi_gateway_command(
            $gateway,
            new GatewayLight(
                $color['hex'],
                $property->device->property('illumination', 1000)
            )
        );
    }

    /**
     * @param mixed $value
     * @return array|\Illuminate\Contracts\Translation\Translator|mixed|null|string
     */
    public function format($value)
    {
        $hex = substr(
            str_pad(dechex($value), 8, '0', STR_PAD_LEFT),
            -6
        );

        return [
            'hex' => $hex,
            'rgb' => $this->hex2rgb($hex)
        ];
    }

    protected function hex2rgb(string $hex)
    {
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
    }
}