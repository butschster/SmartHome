<?php

namespace App\Exceptions;

use App\Contracts\Sayable;
use Exception;

class SayableException extends Exception implements Sayable
{
    public function say(): string
    {
        return $this->getMessage();
    }
}
