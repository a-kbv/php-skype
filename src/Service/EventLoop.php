<?php

namespace Akbv\PhpSkype\Service;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class EventLoop
{
    /**
     * @var \Akbv\PhpSkype\Connection
     */
    private $connection;

    /**
     * @var mixed[] $events
     */
    private $events = [];

    /**
     * @var mixed[] $errorEvents
     */
    private $errorEvents = [];

    /**
     * @var bool
     */
    private $run = false;

    public function __construct(\Akbv\PhpSkype\Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Request one batch of events from Skype, calling @method mixed onEvent() with each event in turn.
     * Subclasses may override this method to alter loop functionality.
     * @return void
     */
    public function cycle(): void
    {
        try {
            $events = $this->connection->getEvents();
        } catch (\Symfony\Component\HttpClient\Exception\ClientException $e) {
            $this->triggerError($e);
            return;
        }

        foreach ($events as $event) {
            $this->triggerEvent($event);
        }
    }
    /**
     * Continuously handle any incoming events using @method cycle().
     * @return void
     */
    public function run(): void
    {
        $this->run = true;
        while ($this->run) {
            $this->cycle();
        }
    }

    /**
     * Stop the event loop.
     * @return void
     */
    public function stop(): void
    {
        $this->run = false;
    }

    /**
     * Register a callback to be called when an event is received.
     *
     * @param \Closure $closure
     */
    public function onEvent(\Closure $closure): void
    {
        $this->events[] = $closure;
    }

    /**
     * Register a callback to be called when an error is received.
     *
     * @param \Closure $closure
     */
    public function onError(\Closure $closure): void
    {
        $this->errorEvents[] = $closure;
    }

    /**
     * @param \Akbv\PhpSkype\Model\SkypeEvent\SkypeEvent $event
     */
    public function triggerEvent(\Akbv\PhpSkype\Model\SkypeEvent\SkypeEvent $event): void
    {
        foreach ($this->events as $closure) {
            $closure($event);
        }
    }

    /**
     * @param \Throwable $throwable
     */
    public function triggerError(\Throwable $throwable): void
    {
        foreach ($this->errorEvents as $closure) {
            $closure($throwable);
        }
    }

}
