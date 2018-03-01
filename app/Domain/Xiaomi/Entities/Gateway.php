<?php

namespace SmartHome\Domain\Xiaomi\Entities;

use SmartHome\App\Entities\Model;
use SmartHome\Domain\Devices\Entities\Device;

class Gateway extends Model
{
    /**
     * @var string
     */
    protected $table = 'xiaomi_gateways';

    /**
     * @var array
     */
    protected $fillable = ['ip', 'sid', 'name', 'description', 'password', 'token'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function devices()
    {
        return $this->belongsToMany(Device::class, 'xiaomi_gateway_device');
    }
}
