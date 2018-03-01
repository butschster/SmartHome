<?php

namespace SmartHome\Http\Xiaomi\Resources;

use Illuminate\Http\Resources\Json\Resource;
use SmartHome\Domain\Xiaomi\Entities\Gateway;

/**
 * @mixin Gateway
 */
class GatewayResource extends Resource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name ?: $this->ip,
            'description' => $this->description,
            'sid' => $this->sid,
            'ip' => $this->ip,
            'password' => $this->password,
            'links' => [
                'self' => route('xiaomi.gateway.show', $this->id),
                'list' => route('xiaomi.gateways')
            ],
        ];
    }
}
