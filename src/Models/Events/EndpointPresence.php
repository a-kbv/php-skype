<?php

namespace Akbv\PhpSkype\Models\Events;

use Akbv\PhpSkype\Utils\Utils;

/**
 * The base message event, when a message is received in a conversation.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class EndpointPresence extends Event
{
    /**
    * User whose presence changed.
    * @var string
    */
    private $userId;

    /**
     * Name of the device connected with this endpoint.
     * @var string
     */
    private $name;

    /**
     * Numeric type of client that the device identifies as.
     * @var string
     */
    private $epType;

    /**
     * Features available on the device.
     * @var mixed[]
     */
    private $capabilities;

    /**
     * Software version of the client.
     * @var string
     */
    private $version;

    public function __construct(array $raw)
    {
        parent::__construct($raw);
        $this->userId = Utils::userUrlToID($raw['resource']['selfLink']);
        $this->name = $raw['resource']['privateInfo']['epname'];
        $this->epType = $raw['resource']['publicInfo']['typ'];
        $this->capabilities = $raw['resource']['publicInfo']['capabilities'];
        $this->version = $raw['resource']['publicInfo']['skypeNameVersion'];
    }

    /**
     * Get user whose presence changed.
     *
     * @return  string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Get name of the device connected with this endpoint.
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * Get features available on the device.
     *
     * @return  mixed[]
     */
    public function getCapabilities()
    {
        return $this->capabilities;
    }

    /**
     * Get numeric type of client that the device identifies as.
     *
     * @return  string
     */
    public function getEpType()
    {
        return $this->epType;
    }

    /**
     * Get software version of the client.
     *
     * @return  string
     */
    public function getVersion()
    {
        return $this->version;
    }
}
