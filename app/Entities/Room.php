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
     * @param string $command
     * @param array $parameters
     * @return void
     */
    public function runCommand(string $command, ...$parameters): void
    {
        foreach ($this->deviceProperties as $property) {
            try {
                $property->runCommand($command, ...$parameters);
            } catch (\App\Exceptions\DevicePropertyCommandNotFound $exception) {

            }
        }
    }
}
