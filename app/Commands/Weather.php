<?php

namespace App\Commands;

use App\Contracts\Sayable;

class Weather implements Sayable
{
    protected $say;

    public function handle()
    {
        /** @var \App\Entities\Weather $weather */
        $weather = \App\Entities\Weather::latest()->firstOrFail();

        $this->say = sprintf(
            'Температура %d градусов. Влажность %d процентов. %s. %s.',
            $weather->temp,
            $weather->humidity,
            $weather->clouds_description,
            $weather->weather_description
        );
    }

    /**
     * @return string
     */
    public function say(): string
    {
        return $this->say;
    }
}