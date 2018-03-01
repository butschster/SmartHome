<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Gateway;

use Illuminate\Contracts\Support\Jsonable;

class Message implements Jsonable
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param array ...$types
     * @return bool
     */
    public function isTypeOf(...$types)
    {
        return in_array($this->type(), $types);
    }

    /**
     * IP адрес шлюза
     * 
     * @return string
     */
    public function ip(): string
    {
        return $this->data['ip'];
    }

    /**
     * Тип команды
     *
     * @return string
     */
    public function type(): string
    {
        return $this->data['cmd'] ?? 'unknown';
    }

    /**
     * Модель устройства
     *
     * @return string
     */
    public function model(): string
    {
        return $this->data['model'] ?? 'unknown';
    }

    /**
     * Идентификатор устройства
     * 
     * @return string
     */
    public function sid(): string
    {
        return $this->data['sid'];
    }

    /**
     * Токен
     *
     * @return string|null
     */
    public function token()
    {
        return array_get($this->data, 'token');
    }

    /**
     * Параметры
     * 
     * @return array
     */
    public function parameters(): array
    {
        return json_decode(array_get($this->data, 'data'), true);
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->data, $options);
    }
}