<?php

namespace App\Entities;

class MqttLog extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['topic', 'message'];
}
