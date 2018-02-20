<?php

namespace App\Entities;

use App\Contracts\Mqtt\Device as DeviceDriverContract;
use App\Exceptions\UnknownDeviceException;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Contracts\Mqtt\DeviceManager as DeviceManagerContract;

class Device extends Model
{
    /**
     * Получение устройства по ключу
     *
     * @param string $key Ключ
     * @param string $type Тип устройства
     *
     * @return Device
     * @throws UnknownDeviceException
     */
    public static function register(string $key, string $type): Device
    {
        $deviceConfig = config('devices.' . $type);
        if (!$deviceConfig) {
            throw new UnknownDeviceException($type);
        }

        return static::firstOrCreate([
            'key' => $key,
            'type' => $type
        ], [
            'name' => array_get($deviceConfig, 'name'),
            'description' => array_get($deviceConfig, 'description'),
            'last_activity' => now()
        ]);
    }

    /**
     * @var array
     */
    protected $fillable = ['key', 'type', 'name', 'description', 'last_activity'];

    /**
     * @var array
     */
    protected $dates = ['last_activity'];

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
        $driver = $this->driver();

        foreach ($driver->allowedProperties() as $property => $class) {
            /** @var \App\Contracts\Mqtt\DeviceProperty $propertyObject */
            $propertyObject = app($class);
            $value = $propertyObject->transform(
                array_get($data, $property)
            );

            if(is_null($value)) {
                continue;
            }

            $this->properties()->updateOrCreate(
                ['key' => $property],
                ['value' => $value]
            );
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
     * @return string|null
     */
    public function getFormattedLastActivityAttribute()
    {
        return $this->last_activity instanceof Carbon
            ? $this->last_activity->toDateTimeString()
            : null;
    }

    /**
     * Обновление времени последней активности устройства
     */
    public function updateLastActivity(): void
    {
        $this->last_activity = now();
        $this->save();

        event(new \App\Events\Device\LastActivityUpdated($this));
    }
}
