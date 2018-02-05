<?php

namespace App\Entities;

use App\Contracts\Mqtt\Device as DeviceContract;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DeviceProperty extends Model
{
    /**
     * @var DeviceContract
     */
    protected $deviceDriver;

    /**
     * @var array
     */
    protected $fillable = ['key', 'value'];

    /**
     * Получение списка доступных команд
     *
     * @return array
     */
    public function getCommands(): array
    {
        return $this->deviceDriver()->allowedCommands($this->key);
    }

    /**
     * Запуск команды через драйвер устройства
     *
     * @param string $method
     * @param array $parameters
     * @return void
     */
    public function runCommand(string $method, ...$parameters): void
    {
        $commands = $this->getCommands();

        if (isset($commands[$method])) {
            $this->deviceDriver()->runCommand($this, $method, ...$parameters);
        }
    }

    /**
     * Ссылка на устройство
     *
     * @return BelongsTo
     */
    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }

    /**
     * @return DeviceContract
     */
    protected function deviceDriver(): DeviceContract
    {
        if (!$this->deviceDriver) {
            $this->deviceDriver = $this->device->driver();
        }

        return $this->deviceDriver;
    }

    /**
     * Список помещений
     *
     * @return BelongsToMany
     */
    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class);
    }

}
