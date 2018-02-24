<?php

namespace SmartHome\Domain\Mqtt;

use SmartHome\App\Entities\Model;

class MqttLog extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['topic', 'message'];
}
