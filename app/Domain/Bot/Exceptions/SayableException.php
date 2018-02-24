<?php

namespace SmartHome\Domain\Bot\Exceptions;

use SmartHome\Domain\Bot\Contracts\Sayable;
use Exception;

class SayableException extends Exception implements Sayable
{
    public function say(): string
    {
        return $this->getMessage();
    }
}
