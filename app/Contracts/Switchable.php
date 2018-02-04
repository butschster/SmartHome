<?php

namespace App\Contracts;

interface Switchable
{
    /**
     * Включение
     *
     * @return void
     */
    public function switchOn(): void;

    /**
     * @return void
     */
    public function switchOff();
}