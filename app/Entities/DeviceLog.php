<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
