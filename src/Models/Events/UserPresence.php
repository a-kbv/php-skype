<?php

namespace Akbv\PhpSkype\Models\Events;

use Akbv\PhpSkype\Utils\Utils;

/**
 * An event for contacts changing status or presence.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class UserPresence extends Event
{
    /**
     * User whose presence changed.
     * @var string
     */
    private $userId;

    /**
     * Whether the user is now connected.
     * @var bool
     */
    private $online;

    /**
     * The user's current status.
     * @var string
     */
    private $status;

    /**
     * Features currently available from this user, across the endpoint.
     * @var mixed[]
     */
    private $capabilities;

    public function __construct(array $raw)
    {
        parent::__construct($raw);
        $this->userId = Utils::UserUrlToID($raw['resource']['selfLink']);
        $this->online = $raw['resource']['availability'] == 'Online';
        $this->status = $raw['resource']['status'];
        $this->capabilities = $raw['resource']['capabilities'];
    }

    /**
     * Get whether the user is now connected.
     *
     * @return  bool
     */
    public function getOnline()
    {
        return $this->online;
    }

    /**
     * Get the user's current status.
     *
     * @return  string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get features currently available from this user, across the endpoint.
     *
     * @return  mixed[]
     */
    public function getCapabilities()
    {
        return $this->capabilities;
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
}
