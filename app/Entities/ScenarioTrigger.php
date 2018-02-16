<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScenarioTrigger extends Model
{

    /**
     * Ссылка на объект свойства
     *
     * @return BelongsTo
     */
    public function deviceProperty(): BelongsTo
    {
        return $this->belongsTo(DeviceProperty::class);
    }
}
