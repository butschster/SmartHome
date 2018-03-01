<?php

namespace SmartHome\Domain\Xiaomi\Entities;

use SmartHome\App\Entities\Model;

class XiaomiLog extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['cmd', 'ip', 'model', 'message'];
}
