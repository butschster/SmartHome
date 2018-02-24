<?php

namespace SmartHome\Domain\Devices\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use SmartHome\App\Entities\Model;

class DeviceLog extends Model
{
    protected $primaryKey = null;

    /**
     * @var array
     */
    protected $fillable = ['message'];

    /**
     * Ссылка на объект устройства
     *
     * @return BelongsTo
     */
    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }
}
