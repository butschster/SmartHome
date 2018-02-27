<?php

namespace SmartHome\Domain\Xiaomi\Contracts\Mihome\Gateway;

use SmartHome\Domain\Xiaomi\MiHome\Gateway\Exceptions\SocketConnectionError;

interface Hub
{
    /**
     * @param Command $command
     * @return Message|null
     * @throws SocketConnectionError
     */
    public function sendCommand(Command $command);

    /**
     * Sleep the script for a given number of seconds.
     *
     * @param  int|float $seconds
     * @return void
     */
    public function sleep($seconds);

    /**
     * Determine if the memory limit has been exceeded.
     *
     * @param  int $memoryLimit
     * @return bool
     */
    public function memoryExceeded(int $memoryLimit);

    /**
     * Kill the process.
     *
     * @param  int $status
     * @return void
     */
    public function kill(int $status = 0);

    /**
     * Stop listening and bail out of the script.
     *
     * @param  int $status
     * @return void
     */
    public function stop(int $status = 0);
}