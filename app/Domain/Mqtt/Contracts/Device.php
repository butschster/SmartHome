<?php

namespace SmartHome\Domain\Mqtt\Contracts;

use SmartHome\Domain\Devices\Exceptions\DevicePropertyNotFoundException;

interface Device
{
    const TYPE_SONOFF_BASIC = 'sonoff_basic';
    const TYPE_SONOFF_DUAL = 'sonoff_dual';
    const TYPE_XIAOMI_TH = 'xiaomi_th';
    const TYPE_XIAOMI_MAGNET = 'xiaomi_magnet';
    const TYPE_XIAOMI_BUTTON = 'xiaomi_switch';

    /**
     * Получение списка доступных датчиков
     *
     * @return array
     */
    public function properties(): array;

    /**
     * Получение списка команд для дайтчиков устроства
     *
     * @param string $property
     * @return array
     */
    public function commands(string $property): array;

    /**
     * Получение названия класса датчика
     *
     * @param string $property
     * @return string
     * @throws DevicePropertyNotFoundException
     */
    public function propertyClass(string $property): string;

    /**
     * Получение объекта датчика устройства
     *
     * @param string $property
     * @return DeviceProperty
     * @throws DevicePropertyNotFoundException
     */
    public function propertyDriver(string $property): DeviceProperty;
}