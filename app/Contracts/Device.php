<?php

namespace App\Contracts;

interface Device
{
    const SOURCE_MQTT = 'mqtt';

    const TYPE_SONOFF_BASIC = 'sonoff_basic';

    /**
     * Добавление свойств
     *
     * @param array $properties
     * @return void
     */
    public function setProperties(array $properties);

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
}