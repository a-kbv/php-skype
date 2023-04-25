<?php

namespace Akbv\PhpSkype\Models;

/**
 * Property for class @see Session that holds data retrieved from Skype.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class Endpoint extends Base
{
    /**
     * "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxx" string obtained from skype when obtaining registration token
     * @var string
     */
    private $id;


    /**
     * @var string
     */
    private $subscribedUrl;

    /**
    * @var bool $presence
    */
    private $presence = false;

    /**
     * Subscribe to contact and conversation events.
     * @var bool $subscribed
     */
    private $subscribed = false;

    /**
     * Enable presence subscriptions for the authenticated user's contacts.
     * @var bool $subscribedPresence
     */
    private $subscribedPresence = false;

    /**
     * Get the value of id
     *
     * @return  string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  string  $id
     *
     * @return  self
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get presence is allowed
     */
    public function getPresence(): bool
    {
        return $this->presence;
    }

    /**
     * Set presence is allowed
     *
     * @param  bool $presence
     *
     * @return self
     */
    public function setPresence($presence): self
    {
        $this->presence = $presence;

        return $this;
    }

    /**
     * Get $subscribed
     *
     * @return  bool
     */
    public function getSubscribed(): bool
    {
        return $this->subscribed;
    }

    /**
     * Set $subscribed
     *
     * @param  bool  $subscribed
     *
     * @return  self
     */
    public function setSubscribed(bool $subscribed): self
    {
        $this->subscribed = $subscribed;

        return $this;
    }

    /**
     * Get $subscribedPresence
     *
     * @return  bool
     */
    public function getSubscribedPresence(): bool
    {
        return $this->subscribedPresence;
    }

    /**
     * Set $subscribedPresence
     *
     * @param  bool  $subscribedPresence  $subscribedPresence
     *
     * @return  self
     */
    public function setSubscribedPresence(bool $subscribedPresence): self
    {
        $this->subscribedPresence = $subscribedPresence;

        return $this;
    }

    /**
     * Get the value of subscribedUrl
     *
     * @return  string
     */
    public function getSubscribedUrl()
    {
        return $this->subscribedUrl;
    }

    /**
     * Set the value of subscribedUrl
     *
     * @param  string  $subscribedUrl
     *
     * @return  self
     */
    public function setSubscribedUrl(string $subscribedUrl)
    {
        $this->subscribedUrl = $subscribedUrl;

        return $this;
    }
}
