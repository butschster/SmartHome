<?php

namespace App\Contracts\Mqtt;

use App\Exceptions\DevicePropertyNotFoundException;

interface Device
{
    const TYPE_SONOFF_BASIC = 'sonoff_basic';
    const TYPE_SONOFF_DUAL = 'sonoff_dual';
    const TYPE_XIAOMI_TH = 'xiaomi_th';
    const TYPE_XIAOMI_MAGNET = 'xiaomi_magnet';

    /**
     * Добавление свойств
     *
     * @param array $properties
     * @return void
     */
    public function setProperties(array $properties);

    /**
     * @return array
     */
    public function allowedProperties(): array;

    /**
     * Добавление идентификатора устройства
     *
     * @param string $id
     * @return void
     */
    public function setId(string $id);

    /**
     * Получение идентификатора устройства
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Получение списка команд для свойства устроства
     *
     * @param string $property
     * @return array
     */
    public function allowedCommands(string $property): array;

    /**
     * Получение названия класса свойства
     *
     * @param string $property
     * @return string
     * @throws DevicePropertyNotFoundException
     */
    public function propertyClass(string $property): string;

    /**
     * Получение объекта свойства
     *
     * @param string $property
     * @return DeviceProperty
     * @throws DevicePropertyNotFoundException
     */
    public function propertyDriver(string $property): DeviceProperty;
}