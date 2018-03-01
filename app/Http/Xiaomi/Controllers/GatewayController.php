<?php

namespace SmartHome\Http\Xiaomi\Controllers;

use Illuminate\Http\Request;
use SmartHome\App\Http\Controller;
use SmartHome\Domain\Xiaomi\Entities\Gateway;
use SmartHome\Http\Xiaomi\Resources\GatewayCollection;
use SmartHome\Http\Xiaomi\Resources\GatewayResource;

class GatewayController extends Controller
{
    public function index()
    {
        return new GatewayCollection(
            Gateway::get()
        );
    }

    /**
     * @param Gateway $gateway
     * @return GatewayResource
     */
    public function show(Gateway $gateway): GatewayResource
    {
        return new GatewayResource($gateway->load('devices'));
    }

    /**
     * @param Request $request
     * @param Gateway $gateway
     * @return GatewayResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Gateway $gateway): GatewayResource
    {
        $this->authorize('update', $gateway);

        $validatedData = $request->validate([
            'name' => 'nullable|string',
            'description' => 'nullable|string',
            'password' => 'nullable'
        ]);

        $gateway->update($validatedData);

        return $this->show($gateway);
    }

    /**
     * @param Gateway $gateway
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Gateway $gateway)
    {
        $this->authorize('destroy', $gateway);

        $gateway->delete();

        return response_ok();
    }
}
