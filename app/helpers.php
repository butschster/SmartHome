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