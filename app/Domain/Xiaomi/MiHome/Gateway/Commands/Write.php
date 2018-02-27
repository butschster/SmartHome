<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Gateway\Commands;

use SmartHome\Domain\Xiaomi\Contracts\Mihome\Gateway\Command;
use SmartHome\Domain\Xiaomi\Entities\Gateway;

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
     * @var string
     */
    private $model;

    /**
     * @var Gateway
     */
    private $gateway;

    /**
     * @param Gateway $gateway
     * @param string $sid
     * @param string $model
     * @param $data
     */
    public function __construct(Gateway $gateway, string $sid, string $model, $data)
    {
        $this->sid = $sid;
        $this->data = $data;
        $this->model = $model;
        $this->gateway = $gateway;
    }

    public function command(): array
    {
        $data = $this->parsedData();
        $data['key'] = $this->makeSignature($this->gateway);

        return [
            'cmd' => 'write',
            'short_id' => 0,
            'sid' => $this->sid,
            'data' => $data
        ];
    }

    protected function parsedData()
    {
        if ($this->data instanceof Command) {
            return $this->data->command();
        }

        return $this->data;
    }

    /**
     * @param Gateway $gateway
     * @return string
     */
    protected function makeSignature(Gateway $gateway): string
    {
        $iv = hex2bin('17996d093d28ddb3ba695a2e6f58562e');
        $hash = base64_decode(openssl_encrypt($gateway->token, 'AES-128-CBC', $gateway->password, OPENSSL_ZERO_PADDING, $iv));

        return bin2hex($hash);
    }
}