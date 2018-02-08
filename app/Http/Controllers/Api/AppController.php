<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Translation\Translator;

class AppController extends Controller
{
    /**
     * @param Translator $translator
     * @return Response
     */
    public function settings(Request $request, Translator $translator): Response
    {
        $content = 'window.settings = ' . json_encode([
            'asset_url' => asset(''),
            'locale' => $translator->locale(),
            'timezone' => config('app.timezone'),
            'websocket' => config('broadcasting.websocket'),
            'debug' => config('app.debug'),
            'user' => new UserResource($request->user())
        ]);

        return new Response($content, 200, [
            'Content-Type' => 'text/javascript',
        ]);
    }
}