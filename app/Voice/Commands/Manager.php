<?php

namespace App\Voice\Commands;

use App\Contracts\Voice\Manager as ManagerContract;
use App\Contracts\Sayable;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Foundation\Application;
use Psr\Log\LoggerInterface;

class Manager implements ManagerContract
{
    /**
     * @var array
     */
    protected $commands = [];

    /**
     * Голосовые команды
     *
     * @var array
     */
    protected $voiceCommands = [];

    /**
     * @var Application
     */
    private $app;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Dispatcher
     */
    private $events;

    /**
     * @param Application $app
     * @param Dispatcher $events
     * @param LoggerInterface $logger
     */
    public function __construct(Application $app, Dispatcher $events, LoggerInterface $logger)
    {
        $this->app = $app;
        $this->logger = $logger;
        $this->events = $events;
    }

    /**
     * @param array $commands
     * @return void
     */
    public function setCommands(array $commands): void
    {
        foreach ($commands as $class => $params) {
            $command = $params['command'];

            $this->commands[$command] = $class;

            $triggers = array_get($params, 'voice.triggers');
            if (is_array($triggers)) {
                $this->voiceCommands[$command] = [
                    'smart' => array_get($params, 'voice.smart', false),
                    'triggers' => $triggers
                ];
            }
        }
    }

    /**
     * Получение списка голосовых комманд
     *
     * @return array
     */
    public function voiceCommands(): array
    {
        return $this->voiceCommands;
    }

    /**
     * @param string $key
     * @param array ...$parameters
     * @return void
     */
    public function handle(string $key, ...$parameters): void
    {
        if (isset($this->commands[$key])) {
            $this->logger->debug(sprintf('Run command [%s]', $key), $parameters);

            $command = $this->app->make($this->commands[$key]);

            try {
                $command->handle(...$parameters);

                if ($command instanceof Sayable) {
                    say($command);
                }
            } catch (\Exception $e) {
                $this->logger->debug(sprintf('Command [%s] not handled. Message: %s', $key, $e->getMessage()));

                if ($e instanceof Sayable) {
                    say($e);
                }
            }
        }
    }
}