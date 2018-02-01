<?php

namespace App\Contracts\Mqtt;

use Illuminate\Contracts\Support\Arrayable;

interface Response extends Arrayable
{
    public function getRoute(): string;

    public function getPayload(): string;
}