<?php

namespace App\Entities;

use App\Contracts\Device as DeviceDriverContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Contracts\Mqtt\DeviceManager as DeviceManagerContract;

class Device extends Model
{
    /**
     * Получение устройства по ключу
     *
     * @param string $key Ключ
     * @param string $source Источник
     * @param string $type Тип устройства
     *
     * @return Device
     */
    public static function getByKey(string $key, string $source, string $type): Device
    {
        return static::firstOrCreate([
            'key' => $key,
            'source' => $source,
            'type' => $type
        ]);
    }

    /**
     * @var array
     */
    protected $fillable = ['key', 'source', 'type'];


    /**
     * Добавление лога
     *
     * @param string $message
     */
    public function log(string $message)
    {
        $this->logs()->create([
            'message' => $message
        ]);
    }

    /**
     * Логи устройства
     *
     * @return HasMany
     */
    public function logs(): HasMany
    {
        return $this->hasMany(DeviceLog::class);
    }

    /**
     * Добавление свойств
     *
     * @param array $data
     */
    public function setProperties(array $data)
    {
        foreach ($data as $key => $value) {
            $this->properties()->updateOrCreate([
                'key' => $key,
            ], [
                'value' => $value
            ]);
        }
    }

    /**
     * Список свойств
     *
     * @return HasMany
     */
    public function properties()
    {
        return $this->hasMany(DeviceProperty::class);
    }

    /**
     * Получение объекта драйвера
     *
     * @return DeviceDriverContract
     */
    public function driver(): DeviceDriverContract
    {
        $manager = app(DeviceManagerContract::class);
        $device = $manager->driver($this->type);

        $device->setId($this->key);

        return $device;
    }

    /**
     * Запуск команды через драйвер устройства
     *
     * @param string $method
     * @param array ...$parameters
     * @return mixed
     */
    public function runCommand(string $method, ...$parameters)
    {
        $device = $this->driver();

        if (!method_exists($device, $method)) {
            throw new \BadMethodCallException("Method [{$method}] not found.");
        }

        $device->setProperties(
            $this->properties()->pluck('value', 'key')->toArray()
        );

        return $device->$method(...$parameters);
    }

}
