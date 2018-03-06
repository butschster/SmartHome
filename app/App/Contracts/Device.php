<?php

namespace SmartHome\App\Contracts;

use SmartHome\Domain\Devices\Entities\DeviceProperty as DevicePropertyEntity;
use SmartHome\Domain\Devices\Exceptions\DevicePropertyNotFoundException;

interface Device
{
    /**
     * Название датчика
     *
     * @return string
     */
    public function name(): string;

    /**
     * Описание датчика
     *
     * @return string/null
     */
    public function description();

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
     * @param DevicePropertyEntity $property
     * @param string $method
     * @param array ...$parameters
     * @throws DevicePropertyNotFoundException
     */
    public function runCommand(DevicePropertyEntity $property, string $method, ...$parameters): void;

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