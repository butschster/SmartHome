<?php

namespace App\Exceptions;

use Exception;

class MqttResponseException extends Exception
{
    public function getResponse()
    {
        return null;
    }
}
