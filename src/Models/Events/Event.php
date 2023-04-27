<?php

namespace Akbv\PhpSkype\Models\Events;

/**
 * The base Skype event. Pulls out common identifier, time and type parameters.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class Event implements \Akbv\PhpSkype\Interfaces\Event
{
    /**
     * Unique identifier of the event, usually starting from ``1000``.
     * @var int The event ID.
     */
    private $id;

    /**
     *  Raw message type, as specified by the Skype API.
     * @var string The event type.
     */
    private $type;

    /**
     * Time at which the event occurred.
     * @var \DateTime The event time.
     */
    private $time;

    /**
     * Resource Type of the event.
     * @var string
     */
    private $resourceType;

    /**
     * Resource Link of the event.
     * @var string
    */
    private $resourceLink;

    /**
     * The raw event data.
     * @var mixed[] The raw event data.
     */
    private $rawData;

    /**
     * Create a new event from a raw event array.
     * @param mixed[] $raw The raw event array.
     */
    public function __construct(array $raw)
    {
        $this->rawData = $raw;
        $this->id = isset($raw['id']) ? $raw['id'] : null;
        $this->type = isset($raw['resourceType']) ? $raw['resourceType'] : null;
        $this->time = isset($raw['time']) ? \DateTime::createFromFormat("Y-m-d\TH:i:s\Z", $raw['time']) : new \DateTime();
        $this->resourceType = isset($raw['resourceType']) ? $raw['resourceType'] : null;
        $this->resourceLink = isset($raw['resourceLink']) ? $raw['resourceLink'] : null;
    }

    /**
     * Acknowledge receipt of an event, if a response is required.
     */
    public function acknowledge(): void
    {
        $url = isset($this->rawData['resource']['ackrequired']) ? $this->rawData['resource']['ackrequired'] : null;
        if ($url) {
            //create POST request to acknowledge the event
        }
    }


    /**
     * @return  string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Get the value of rawData
     * @return  mixed[]
     */
    public function getRawData(): array
    {
        return $this->rawData;
    }

    /**
     * Get the event time.
     *
     * @return  \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Get the event ID.
     *
     * @return  int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get resource Link of the event.
     *
     * @return  string
     */
    public function getResourceLink()
    {
        return $this->resourceLink;
    }

    /**
     * Get resource Type of the event.
     *
     * @return  string
     */
    public function getResourceType()
    {
        return $this->resourceType;
    }
}
