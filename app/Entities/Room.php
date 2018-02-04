<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Room extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'position'];

    /**
     * @var array
     */
    protected $casts = [
        'position' => 'integer'
    ];

    /**
     * @return BelongsToMany
     */
    public function deviceProperties(): BelongsToMany
    {
        return $this->belongsToMany(DeviceProperty::class);
    }

    /**
     * Запуск команды на всех устройствах в помещении
     *
     * @param string $method
     * @param array $parameters
     * @return void
     */
    public function runCommand(string $method, ...$parameters): void
    {
        foreach ($this->deviceProperties as $property) {
            $property->runCommand($method, ...$parameters);
        }
    }
}
