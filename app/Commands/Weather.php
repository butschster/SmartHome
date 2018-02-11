<?php

namespace App\Commands;

use App\Contracts\Sayable;
use App\Exceptions\SayableException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Weather implements Sayable
{
    /**
     * @return array
     */
    public static function triggers(): array
    {
        return [
            'какая сегодня погода'
        ];
    }

    /**
     * @var string
     */
    protected $say;

    public function handle()
    {
        try {
            /** @var \App\Entities\Weather $weather */
            $weather = \App\Entities\Weather::latest()->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new SayableException('На данный момент у меня нет данных о погоде. Спросите позже.');
        }

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