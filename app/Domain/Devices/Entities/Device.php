<?php

namespace SmartHome\Domain\Devices\Entities;

use SmartHome\App\Contracts\DeviceManager;
use SmartHome\App\Entities\Model;
use SmartHome\App\Contracts\Device as DeviceDriverContract;
use SmartHome\App\Exceptions\UnknownDeviceException;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SmartHome\App\Contracts\DeviceManager as DeviceManagerContract;
use SmartHome\Domain\Devices\Events\DeviceProperty\Set;

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

        $driver = $manager->driver($type);

        return static::firstOrCreate([
            'key' => $key,
            'type' => $type
        ], [
            'name' => $driver->name(),
            'description' => $driver->description(),
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

        $i = 0;

        foreach ($driver->properties() as $property => $class) {
            $i++;

            if (!isset($data[$property])) {
                continue;
            }

            $this->setProperty($class, $property, $data, $i);
        }
    }

    /**
     * Получение зтекущего начения датчика
     *
     * @param string $name
     * @param null $default
     * @return mixed
     */
    public function property(string $name, $default = null)
    {
        $property = $this->properties()->where('key', $name)->first(['value']);

        if ($property) {
            return $property->value;
        }

        return $default;
    }

    /**
     * @param string $class
     * @param string $property
     * @param array $data
     * @param int $position
     * @return DeviceProperty
     */
    protected function setProperty(string $class, string $property, array $data, int $position): DeviceProperty
    {
        /** @var \SmartHome\App\Contracts\DeviceProperty $propertyObject */
        $propertyObject = app($class);
        $value = $propertyObject->transform(
            array_get($data, $property)
        );

        $property = $this->properties()->updateOrCreate(
            ['key' => $property],
            [
                'value' => $value,
                'name' => $propertyObject->name(),
                'description' => $propertyObject->description(),
                'position' => $position
            ]
        );

        event(new Set($property));

        return $property;
    }

    /**
     * Список свойств
     *
     * @return HasMany
     */
    public function properties()
    {
        return $this->hasMany(DeviceProperty::class)->orderBy('position');
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
