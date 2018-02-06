<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Translation\Translator;

class AppController extends Controller
{
    /**
     * @param Translator $translator
     * @return Response
     */
    public function settings(Translator $translator): Response
    {
        $content = 'window.settings = ' . json_encode([
            'asset_url' => asset(''),
            'locale' => $translator->locale(),
            'timezone' => config('app.timezone'),
            'websocket' => config('broadcasting.websocket'),
            'debug' => config('app.debug')
        ]);

        return new Response($content, 200, [
            'Content-Type' => 'text/javascript',
        ]);
    }
}