<?php

namespace SmartHome\Domain\Devices\Entities;

use SmartHome\App\Contracts\DeviceManager;
use SmartHome\App\Entities\Model;
use SmartHome\App\Contracts\Device as DeviceDriverContract;
use SmartHome\App\Exceptions\UnknownDeviceException;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SmartHome\App\Contracts\DeviceManager as DeviceManagerContract;

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
        /** @var DeviceManager $manager */
        $manager = app(DeviceManager::class);

        $drivers = $manager->getDrivers();
        if (!isset($drivers[$type])) {
            throw new UnknownDeviceException($type);
        }

        $driver = $drivers[$type];

        return static::firstOrCreate([
            'key' => $key,
            'type' => $type
        ], [
            'name' => array_get($driver, 'name'),
            'description' => array_get($driver, 'description'),
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

        foreach ($driver->properties() as $property => $class) {
            if (!isset($data[$property])) {
                continue;
            }

            /** @var \SmartHome\App\Contracts\DeviceProperty $propertyObject */
            $propertyObject = app($class);
            $value = $propertyObject->transform(
                array_get($data, $property)
            );

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

        return $manager->driver($this->type);
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

        event(new \SmartHome\Domain\Devices\Events\Device\LastActivityUpdated($this));
    }
}
