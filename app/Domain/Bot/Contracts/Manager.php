<?php

namespace SmartHome\Domain\Bot\Contracts;

interface Manager
{
    /**
     * @param array $commands
     * @return void
     */
    public function setCommands(array $commands): void;

    /**
     * Получение списка голосовых комманд
     *
     * @return array
     */
    public function voiceCommands(): array;


    /**
     * @param string $key
     * @param array ...$parameters
     * @return void
     */
    public function handle(string $key, ...$parameters): void;
}