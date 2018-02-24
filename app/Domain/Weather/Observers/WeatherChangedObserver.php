<?php

namespace SmartHome\Domain\Weather\Observers;

use SmartHome\Domain\Weather\Events\WeatherUpdated;
use SmartHome\Domain\Weather\Weather;
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