<?php

namespace App\Commands;

use App\Commands\Room\SwitchOffCommand;
use App\Commands\Room\SwitchOnCommand;
use App\Contracts\Sayable;
use App\Events\Say;
use App\Events\SpechCommandHandleError;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Foundation\Application;
use Psr\Log\LoggerInterface;

class Manager
{
    protected $commands = [
        'room:switch_on' => SwitchOnCommand::class,
        'room:switch_off' => SwitchOffCommand::class,
        'weather' => Weather::class
    ];

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
                    $this->events->dispatch(new Say($command->say()));
                }
            } catch (\Exception $e) {
                $this->logger->debug(sprintf('Command [%s] not handled. Message: %s', $key, $e->getMessage()));

                if ($e instanceof Sayable) {
                    $this->events->dispatch(new Say($e->say()));
                }
            }
        }
    }
}