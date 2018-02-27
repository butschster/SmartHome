<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Gateway\Commands;

use SmartHome\Domain\Xiaomi\Contracts\Mihome\Gateway\Command;

class Write implements Command
{
    /**
     * @var string
     */
    private $sid;

    /**
     * @var string
     */
    private $data;

    /**
     * @param string $sid
     * @param string $data
     */
    public function __construct(string $sid, $data)
    {
        $this->sid = $sid;
        $this->data = $data;
    }

    public function command(): array
    {
        return [
            'cmd' => 'write',
            'sid' => $this->sid,
            'data' => $this->parsedData()
        ];
    }

    protected function parsedData()
    {
        if ($this->data instanceof Command) {
            return $this->data->command();
        }

        return $this->data;
    }
}