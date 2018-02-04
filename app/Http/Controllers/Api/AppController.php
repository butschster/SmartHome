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
    public function settings(Translator $translator)
    {
        $content = 'window.settings = '.json_encode([
            'asset_url' => asset(''),
            'locale' => $translator->locale(),
            'websocket' => config('broadcasting.websocket')
        ]);

        return new Response($content, 200, [
            'Content-Type' => 'text/javascript',
        ]);
    }
}