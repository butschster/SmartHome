<?php

namespace SmartHome\Domain\Rooms\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use SmartHome\App\Entities\Model;
use SmartHome\Domain\Devices\Entities\DeviceProperty;

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
            } catch (\SmartHome\Domain\Devices\Exceptions\DevicePropertyCommandNotFound $exception) {

            }
        }
    }
}
