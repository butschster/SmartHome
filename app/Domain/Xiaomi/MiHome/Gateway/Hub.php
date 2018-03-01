<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Gateway;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\DetectsLostConnections;
use Illuminate\Queue\QueueManager;
use SmartHome\Domain\Xiaomi\Contracts\Mihome\Gateway\Command;
use SmartHome\Domain\Xiaomi\Contracts\Mihome\Gateway\Hub as HubContract;
use SmartHome\Domain\Xiaomi\MiHome\Gateway\Commands\{
    DiscoverDevices, DiscoverGateway, ReadDevice
};
use SmartHome\Domain\Xiaomi\MiHome\Gateway\Exceptions\SocketConnectionError;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Illuminate\Contracts\Debug\ExceptionHandler;

class Hub implements HubContract
{
    use DetectsLostConnections;

    const MULTICAST_ADDRESS = '224.0.0.50';
    const MULTICAST_PORT = 9898;
    const GATEWAY_DISCOVERY_ADDRESS = '224.0.0.50';
    const GATEWAY_DISCOVERY_PORT = 4321;
    const SOCKET_BUFSIZE = 1024;

    const DEVICE_DISCOVERY_TIMEOUT = 300;

    /**
     * @var resource
     */
    protected $connection;

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * @var DeviceManager
     */
    protected $manager;

    /**
     * @var Dispatcher
     */
    protected $events;

    /**
     * @var bool
     */
    protected $shouldQuit = false;

    /**
     * The exception handler instance.
     *
     * @var \Illuminate\Contracts\Debug\ExceptionHandler
     */
    protected $exceptions;

    /**
     * @var int
     */
    public $discoverDevicesTimer;

    /**
     * @var QueueManager
     */
    protected $queueManager;

    /**
     * @param Dispatcher $events
     * @param ExceptionHandler $exceptions
     * @param DeviceManager $manager
     * @param QueueManager $queueManager
     */
    public function __construct(Dispatcher $events,
                                ExceptionHandler $exceptions,
                                DeviceManager $manager,
                                QueueManager $queueManager
    )
    {
        $this->manager = $manager;
        $this->events = $events;
        $this->exceptions = $exceptions;
        $this->queueManager = $queueManager;
    }

    public function __destruct()
    {
        socket_close($this->connection);

        $this->info('Connection closed');
    }

    /**
     * @param OutputInterface $output
     * @throws SocketConnectionError
     */
    public function connect(OutputInterface $output)
    {
        $this->output = $output;

        $this->info('Creating socket');

        if (!($this->connection = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP))) {
            $this->handleSocketException("Failed to create socket");
        }

        $this->info('Socket created');

        if (!socket_bind($this->connection, '0.0.0.0', static::MULTICAST_PORT)) {
            $this->handleSocketException("Could not bind socket");
        }

        $this->info('Socket bind OK');

        $this->sendCommand(new DiscoverGateway());

        $this->configureSocket();

        app()->instance(HubContract::class, $this);
    }

    public function listenMessages()
    {
        while (true) {
            if (!$this->daemonShouldRun()) {
                $this->pauseWorker();
                continue;
            }

            $this->tick();

            $this->stopIfNecessary();
        }
    }

    protected function tick()
    {
        try {
            // Запуск одной команды из очереди
            $this->runQueuedCommand();

            // Опрос устройств
            $this->discoverDevices();

            //
            $this->processMessage(
                $this->listenMessage()
            );

        } catch (\Exception $e) {
            $this->exceptions->report($e);
            $this->writeStatus($e->getMessage(), 'error');

            $this->stopWorkerIfLostConnection($e);
        } catch (\Throwable $e) {
            $this->exceptions->report($e = new FatalThrowableError($e));
            $this->writeStatus($e->getMessage(), 'error');
            $this->stopWorkerIfLostConnection($e);
        }
    }

    /**
     * Get the next job from the queue connection.
     *
     * @param  \Illuminate\Contracts\Queue\Queue  $connection
     * @param  string  $queue
     * @return \Illuminate\Contracts\Queue\Job|null
     */
    protected function getNextCommandJob($connection, $queue)
    {
        foreach (explode(',', $queue) as $queue) {
            if (! is_null($job = $connection->pop($queue))) {
                return $job;
            }
        }
    }

    protected function resetDiscoverDevicesTimer()
    {
        $this->discoverDevicesTimer = static::DEVICE_DISCOVERY_TIMEOUT;
    }

    /**
     * @return Message|null
     */
    protected function listenMessage()
    {
        $json = null;
        socket_recvfrom($this->connection, $json, static::SOCKET_BUFSIZE, 0, $remoteIp, $remotePort);

        if (!empty($json)) {
            $this->info("{$json} from {$remoteIp}:{$remotePort}");

            $json = json_decode($json, true);
            $json['ip'] = $remoteIp;
            $json['port'] = $remotePort;

            $message = new Message($json);

            $this->events->dispatch(new Events\MessageReceived(
                $message, $remoteIp
            ));

            return $message;
        }
    }

    /**
     * @param Message $message
     * @throws SocketConnectionError
     */
    protected function processMessage($message)
    {
        if (!$message) {
            return;
        }

        if ($this->manager->isValidMessage($message)) {
            $this->manager->processMessage($message);
        }

        if ($message->isTypeOf('get_id_list_ack')) {
            $this->readDeviceInformation(
                $message->parameters()
            );
        }
    }

    /**
     * Stop the worker if we have lost connection to a database.
     *
     * @param  \Throwable $e
     * @return void
     */
    protected function stopWorkerIfLostConnection($e)
    {
        if ($this->causedByLostConnection($e)) {
            $this->shouldQuit = true;
        }
    }

    /**
     * @param Command $command
     * @return Message|null
     * @throws SocketConnectionError
     */
    public function sendCommand(Command $command)
    {
        $this->events->dispatch(
            new Events\SendCommand($this->connection, $command)
        );

        $message = $this->encodeMessage($command);

        $this->info("Sending message [{$message}]");

        if (!socket_sendto(
            $this->connection,
            $message,
            strlen($message),
            0,
            static::MULTICAST_ADDRESS,
            static::MULTICAST_PORT
        )) {

            $this->handleSocketException("Cannot send message");
        };

        $response = $this->listenMessage();

        if (!$response) {
            $this->info("No response from Gateway");
        }

        return $response;
    }

    /**
     * @param Command $command
     * @return string
     */
    protected function encodeMessage(Command $command): string
    {
        return json_encode(
            $command->command()
        );
    }

    /**
     * @param string $message
     */
    protected function info(string $message)
    {
        $this->writeStatus($message, 'info');
    }

    /**
     * @param string $message
     * @param string $type
     */
    protected function writeStatus(string $message, string $type): void
    {
        $this->output->writeln(sprintf(
            "<{$type}>[%s]</{$type}> %s",
            now()->format('Y-m-d H:i:s'),
            $message
        ));
    }

    protected function configureSocket(): void
    {
        socket_set_option($this->connection, SOL_SOCKET, SO_BROADCAST, 1);
        socket_set_option($this->connection, SOL_SOCKET, SO_RCVTIMEO, array("sec" => 1, "usec" => 0));
        socket_set_option($this->connection, IPPROTO_IP, IP_MULTICAST_LOOP, true);
        socket_set_option($this->connection, IPPROTO_IP, IP_MULTICAST_TTL, 32);
        socket_set_option($this->connection, IPPROTO_IP, MCAST_JOIN_GROUP, array("group" => static::MULTICAST_ADDRESS, "interface" => 0, "source" => 0));
    }

    /**
     * @param string $message
     * @throws SocketConnectionError
     */
    protected function handleSocketException(string $message): void
    {
        $errorCode = socket_last_error();
        $errorMsg = socket_strerror($errorCode);

        throw new SocketConnectionError(sprintf(
            "%s [%s] %s",
            $message,
            $errorCode,
            $errorMsg
        ));
    }

    /**
     * Determine if the daemon should process on this iteration.
     *
     * @return bool
     */
    protected function daemonShouldRun()
    {
        return !($this->events->until(new Events\Looping($this)) === false);
    }

    /**
     * Stop the process if necessary.
     */
    protected function stopIfNecessary()
    {
        if ($this->shouldQuit) {
            $this->kill();
        }

        if ($this->memoryExceeded(128)) {
            $this->stop(12);
        }
    }

    /**
     * Stop listening and bail out of the script.
     *
     * @param  int $status
     * @return void
     */
    public function stop(int $status = 0)
    {
        $this->events->dispatch(new Events\WorkerStopping);

        exit($status);
    }

    /**
     * Kill the process.
     *
     * @param  int $status
     * @return void
     */
    public function kill(int $status = 0)
    {
        $this->events->dispatch(new Events\WorkerStopping);

        exit($status);
    }

    /**
     * Determine if the memory limit has been exceeded.
     *
     * @param  int $memoryLimit
     * @return bool
     */
    public function memoryExceeded(int $memoryLimit)
    {
        return (memory_get_usage() / 1024 / 1024) >= $memoryLimit;
    }

    /**
     * Pause the worker for the current loop.
     *
     * @return void
     */
    protected function pauseWorker()
    {
        $this->sleep(1);

        $this->stopIfNecessary();
    }

    /**
     * Sleep the script for a given number of seconds.
     *
     * @param  int|float $seconds
     * @return void
     */
    public function sleep($seconds)
    {
        if ($seconds < 1) {
            usleep($seconds * 1000000);
        } else {
            sleep($seconds);
        }
    }

    protected function discoverDevices(): void
    {
        if ($this->discoverDevicesTimer == 0) {
            $this->sendCommand(new DiscoverDevices());
            $this->resetDiscoverDevicesTimer();
        }

        $this->discoverDevicesTimer--;
    }

    /**
     * @param array $sids
     * @throws SocketConnectionError
     */
    protected function readDeviceInformation(array $sids)
    {
        foreach ($sids as $sid) {
            $this->sendCommand(new ReadDevice($sid));
        }
    }

    protected function runQueuedCommand(): void
    {
        $job = $this->getNextCommandJob(
            $this->queueManager->connection(config('queue.default')),
            'xiaomi_commands'
        );

        if ($job) {
            $job->fire();
        }
    }
}