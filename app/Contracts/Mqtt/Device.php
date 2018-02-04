<?php

namespace App\Contracts\Mqtt;

interface Device
{
    const TYPE_SONOFF_BASIC = 'sonoff_basic';
    const TYPE_SONOFF_DUAL = 'sonoff_dual';

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
}