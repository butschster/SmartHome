<?php

namespace SmartHome\Domain\Mqtt\Router;

use SmartHome\Domain\Mqtt\Contracts\Response as ResponseContract;

class Response implements ResponseContract
{
    /**
     * @var string
     */
    private $topic;
    /**
     * @var string
     */
    private $message;

    /**
     * @param string $topic
     * @param string $message
     */
    public function __construct(string $topic, string $message)
    {
        $this->topic = $topic;
        $this->message = $message;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        $array = json_decode($this->message, true);

        if (!$array && json_last_error_msg()) {
            return [$this->message];
        }

        return $array;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->topic;
    }

    /**
     * @return string
     */
    public function getPayload(): string
    {
        return $this->message;
    }
}