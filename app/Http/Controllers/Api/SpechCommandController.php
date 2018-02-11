<?php

namespace App\Http\Controllers\Api;

use App\Commands\Manager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Wamania\Snowball\Russian as Stemmer;

class SpechCommandController extends Controller
{
    /**
     * @var Manager
     */
    private $manager;

    /**
     * @var Stemmer
     */
    private $stemmer;

    /**
     * @param Manager $manager
     * @param Stemmer $stemmer
     */
    public function __construct(Manager $manager, Stemmer $stemmer)
    {
        $this->manager = $manager;
        $this->stemmer = $stemmer;
    }

    /**
     * @return array
     */
    public function triggers()
    {
        return $this->manager->triggers();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function invoke(Request $request)
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
