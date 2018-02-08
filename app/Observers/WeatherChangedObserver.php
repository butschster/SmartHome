<?php

namespace App\Observers;

use App\Entities\Weather;
use App\Events\WeatherUpdated;
use Illuminate\Contracts\Events\Dispatcher;

class WeatherChangedObserver
{
    /**
     * @var Dispatcher
     */
    private $events;

    /**
     * @param Dispatcher $events
     */
    public function __construct(Dispatcher $events)
    {
        $this->events = $events;
    }

    public function created(Weather $weather)
    {
        $this->events->dispatch(new WeatherUpdated($weather));
    }
}