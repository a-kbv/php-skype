<?php

namespace Akbv\PhpSkype\Services;

use Akbv\PhpSkype\Client;
use Akbv\PhpSkype\Exceptions\SessionFileLoadException;
use Akbv\PhpSkype\Exceptions\ClientException;

/**
 * Create a new event loop
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class EventLoop
{
    /**
     * @var Client
     */
    private $client;

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

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Request one batch of events from Skype, calling @method mixed onEvent() with each event in turn.
     * Subclasses may override this method to alter loop functionality.
     * @return void
     */
    public function cycle(): void
    {
        //if the session is not valid, then login
        if ($this->getClient()->getSession()->getExpiry() < new \DateTime()) {
            $this->triggerError(new SessionFileLoadException('Session expired'));
            return;
        }

        try {
            $events = $this->getClient()->getEvents();
        } catch (ClientException $e) {
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
     * @param \Akbv\PhpSkype\Models\Event $event
     */
    public function triggerEvent(\Akbv\PhpSkype\Models\Event $event): void
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

    /**
     * Get the value of client
     *
     * @return  Client
     */
    public function getClient()
    {
        return $this->client;
    }
}
