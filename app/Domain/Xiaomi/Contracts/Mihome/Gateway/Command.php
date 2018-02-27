<?php

namespace SmartHome\Domain\Xiaomi\Contracts\Mihome\Gateway;

interface Command
{
    public function command(): array;
}