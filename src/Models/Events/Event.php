<?php

namespace Akbv\PhpSkype\Models\Events;

/**
 * The base Skype event. Pulls out common identifier, time and type parameters.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
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
     * The event object.
     * @var Object
     */
    private $event;

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
        $messageType = isset($raw['resource']['messagetype']) ? $raw['resource']['messagetype'] : null;

        if ($this->getResourceType() == 'NewMessage') {
            if (!empty($messageType)) {
                $types = ['Text', 'RichText', 'RichText/Contacts', 'RichText/Media_GenericFile', 'RichText/UriObject'];
                if (in_array($messageType, $types)) {
                    if (isset($this->getRawData()['resource']['skypeeditedid'])) {
                        $this->event = new \Akbv\PhpSkype\Models\Events\EditMessageEvent($this->getRawData());
                    } else {
                        $this->event = new \Akbv\PhpSkype\Models\Events\NewMessage($this->getRawData());
                    }
                } elseif ($messageType == 'Control/Typing' || $messageType == 'Control/ClearTyping') {
                    $this->event = new \Akbv\PhpSkype\Models\Events\TypingEvent($this->getRawData());
                } elseif ($messageType == 'Event/Call') {
                    $this->event = new \Akbv\PhpSkype\Models\Events\CallEvent($this->getRawData());
                }
            }
        } elseif ($this->getResourceType() == 'UserPresence') {
            $this->event = new \Akbv\PhpSkype\Models\Events\UserPresence($this->getRawData());
        } elseif ($this->getResourceType() == 'EndpointPresence') {
            $this->event = new \Akbv\PhpSkype\Models\Events\EndpointPresence($this->getRawData());
        } elseif ($this->getResourceType() == 'ThreadUpdate') {
            $this->event = new \Akbv\PhpSkype\Models\Events\ThreadUpdate($this->getRawData());
        } elseif ($this->getResourceType() == 'ConversationUpdate') {
            $this->event = new \Akbv\PhpSkype\Models\Events\ConversationUpdate($this->getRawData());
        } else {
            $this->event = $this;
        }
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

    /**
     * Get the value of event
     * @return Object
     */
    public function getEvent(): Object
    {
        return $this->event;
    }
}
