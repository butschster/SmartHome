<?php

namespace SmartHome\Domain\Bot\Contracts;

interface Sayable
{
    public function say(): string;
}