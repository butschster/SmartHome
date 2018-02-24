<?php

namespace SmartHome\Http\Settings\Controllers;

use SmartHome\App\Http\Controller;
use SmartHome\Domain\Users\Entities\User;
use SmartHome\Http\Users\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Translation\Translator;

class SettingsController extends Controller
{
    /**
     * @param Request $request
     * @param Translator $translator
     * @return Response
     */
    public function show(Request $request, Translator $translator): Response
    {
        $content = 'window.settings = ' . json_encode([
            'asset_url' => asset(''),
            'locale' => $translator->locale(),
            'timezone' => config('app.timezone'),
            'websocket' => config('broadcasting.websocket'),
            'debug' => config('app.debug'),
            'user' => new UserResource($request->user() ?: new User())
        ]);

        return new Response($content, 200, [
            'Content-Type' => 'text/javascript',
        ]);
    }
}