<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DevicePropertyLog extends Model
{
    protected $primaryKey = null;

    /**
     * @var array
     */
    protected $fillable = ['value'];

    /**
     * Ссылка на объект свойства
     *
     * @return BelongsTo
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(DeviceProperty::class, 'device_property_id');
    }
}
