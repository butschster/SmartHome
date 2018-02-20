<?php

namespace App\Entities;

use App\Contracts\Mqtt\Device as DeviceContract;
use App\Contracts\Mqtt\DeviceProperty as DevicePropertyContract;
use App\Exceptions\DevicePropertyCommandNotFound;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeviceProperty extends Model
{
    /**
     * @var DeviceContract
     */
    protected $deviceDriver;

    /**
     * @var array
     */
    protected $fillable = ['key', 'value', 'name', 'description'];

    /**
     * Получение списка доступных команд
     *
     * @return array
     */
    public function commands(): array
    {
        return $this->deviceDriver()->commands($this->key);
    }

    /**
     * @return array
     * @throws \App\Exceptions\DevicePropertyNotFoundException
     */
    public function getMetaAttribute(): array
    {
        return $this->driver()->meta();
    }

    /**
     * Запуск команды через драйвер устройства
     *
     * @param string $command
     * @param array $parameters
     * @return void
     * @throws DevicePropertyCommandNotFound
     */
    public function runCommand(string $command, ...$parameters): void
    {
        $commands = $this->commands();

        if (!isset($commands[$command])) {
            throw new DevicePropertyCommandNotFound($command);
        }

        $this->deviceDriver()->runCommand($this, $command, ...$parameters);

        event(new \App\Events\DeviceProperty\CommandRun($this, $command));
    }

    /**
     * @return HasMany
     */
    public function scenarios(): HasMany
    {
        return $this->hasMany(Scenario::class);
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
     * @return string
     * @throws \App\Exceptions\DevicePropertyNotFoundException
     */
    public function driverClass(): string
    {
        return $this->deviceDriver()->propertyClass($this->key);
    }

    /**
     * @return DevicePropertyContract
     * @throws \App\Exceptions\DevicePropertyNotFoundException
     */
    public function driver(): DevicePropertyContract
    {
        return $this->deviceDriver()->propertyDriver($this->key);
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

    /**
     * Логи устройства
     *
     * @return HasMany
     */
    public function logs(): HasMany
    {
        return $this->hasMany(DevicePropertyLog::class);
    }

    /**
     * Логирование текущего значения
     */
    public function logValue()
    {
        if ($this->isDirty('value')) {
            $this->logs()->create([
                'value' => $this->getOriginal('value')
            ]);
        }
    }

    /**
     * Получение предыдущего значения (Если оно логируется)
     *
     * @return string|null
     */
    public function prevValue()
    {
        return $this->logs()->latest()->value('value');
    }

    /**
     * @return null|string
     */
    public function getPrevValueAttribute()
    {
        return $this->prevValue();
    }
}
