<?php

namespace SmartHome\Domain\Bot\Listeners;

class SayCommandNotFound
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        say('Произошла ошибка при выполнении команды.');
    }
}
