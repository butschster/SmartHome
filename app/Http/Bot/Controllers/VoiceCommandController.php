<?php

namespace SmartHome\Http\Bot\Controllers;

use SmartHome\App\Http\Controller;
use SmartHome\Domain\Bot\Contracts\Manager as ManagerContract;
use Illuminate\Http\Request;
use Wamania\Snowball\Russian as Stemmer;

class VoiceCommandController extends Controller
{
    /**
     * @var ManagerContract
     */
    private $manager;

    /**
     * @var Stemmer
     */
    private $stemmer;

    /**
     * @param ManagerContract $manager
     * @param Stemmer $stemmer
     */
    public function __construct(ManagerContract $manager, Stemmer $stemmer)
    {
        $this->manager = $manager;
        $this->stemmer = $stemmer;
    }

    /**
     * @return array
     */
    public function commands()
    {
        return $this->manager->voiceCommands();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function handle(Request $request)
    {
        $request->validate([
            'command' => 'required|string',
            'text' => 'string'
        ]);

        $this->manager->handle(
            $request->input('command'),
            $this->stemmer->stem($request->input('text'))
        );

        return response_ok();
    }
}
