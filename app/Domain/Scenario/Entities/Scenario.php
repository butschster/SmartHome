<?php

namespace SmartHome\Domain\Scenario\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use SmartHome\App\Entities\Model;

class Scenario extends Model
{
    /**
     * Тригеры
     *
     * @return BelongsToMany
     */
    public function triggers(): BelongsToMany
    {
        return $this->belongsToMany(ScenarioTrigger::class);
    }

    /**
     * Действия
     *
     * @return BelongsToMany
     */
    public function actions(): BelongsToMany
    {
        return $this->belongsToMany(ScenarioAction::class, 'scenario_action');
    }
}
