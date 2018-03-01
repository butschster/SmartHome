<?php

use SmartHome\Domain\Users\Entities\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Notifications\Notification;

/**
 * @return JsonResponse
 */
function response_ok(): JsonResponse
{
    return new JsonResponse(['status' => 'ok']);
}

/**
 * @param int $status
 * @return JsonResponse
 */
function response_error(int $status = 404): JsonResponse
{
    return new JsonResponse(['status' => 'fail'], $status);
}

/**
 * @param $message
 */
function say($message)
{
    if ($message instanceof \SmartHome\Domain\Bot\Contracts\Sayable) {
        $message = $message->say();
    }

    event(new SmartHome\Domain\Bot\Events\Say($message));

    logger('Said message', ['message' => $message]);
}

/**
 * @param Notification $notification
 */
function notify(Notification $notification)
{
    bot()->notify($notification);
}

/**
 * @return User
 */
function bot(): User
{
    return User::bot();
}

function xiaomi_gateway_command(\SmartHome\Domain\Xiaomi\Entities\Gateway $gateway, \SmartHome\Domain\Xiaomi\Contracts\Mihome\Gateway\Command $command)
{
    dispatch(new \SmartHome\Domain\Xiaomi\MiHome\Jobs\SendCommand(
        $command,
        $gateway->ip, $gateway->sid, 'gateway'
    ));
}