<?php

namespace SmartHome\Domain\Scenario\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use SmartHome\App\Entities\Model;
use SmartHome\Domain\Devices\Entities\DeviceProperty;

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
