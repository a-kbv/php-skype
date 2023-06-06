<?php

namespace Akbv\PhpSkype\Models\Events;

use Akbv\PhpSkype\Utils\Utils;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class Properties extends \Akbv\PhpSkype\Models\Base
{
    /**
     * The deliveryReceipt for this thread.
     * @var string
     */
    private $deliveryReceipt;

    /**
     * The consumptionhorizonpublished for this thread.
     * @var string
     */
    private $consumptionhorizonpublished;

    /**
     * The lastimreceivedtime for this thread.
     * @var string
     */
    private $lastimreceivedtime;


    /**
     * The pinned for this thread.
     * @var string
     */
    private $pinned;

    /**
     * The isfollowed for this thread.
     * @var string
     */
    private $isfollowed;

    /**
     * The isemptyconversation for this thread.
     * @var string
     */
    private $isemptyconversation;

    /**
     * The favorite for this thread.
     * @var string
     */
    private $favorite;

    /**
     * The consumptionhorizon for this thread.
     * @var string
     */
    private $consumptionhorizon;

    /**
     * The topic for this thread.
     * @var string
     */
    private $topic;

    /**
     * The creatorcid for this thread.
     * @var string
     */
    private $creatorcid;

    /**
     * The moderatedthread for this thread.
     * @var string
     */
    private $moderatedthread;

    /**
     * The creator for this thread.
     * @var string
     */
    private $creator;

    /**
     * The createdat for this thread.
     * @var string
     */
    private $createdat;

    /**
     * The picture for this thread.
     * @var string
     */
    private $picture;

    /**
     * The historydisclosed for this thread.
     * @var string
     */
    private $historydisclosed;

    /**
     * The joiningenabled for this thread.
     * @var string
     */
    private $joiningenabled;

    /**
     * The capabilities for this thread.
     * @var string[]
     */
    private $capabilities;

    /**
     * The conversationstatusproperties for this thread.
     * @var string
     */
    private $conversationstatusproperties;

    /**
     * The conversationstatus for this thread.
     * @var string
     */
    private $conversationstatus;

    /**
     * The awareness_conversationLiveState for this thread.
     * @var string
     */
    private $awareness_conversationLiveState;

    /**
     * The subscription for this thread.
     * @var string
     */
    private $subscription;

    /**
     * The alerts for this thread.
     * @var string
     */
    private $alerts;

    /**
     * The disableanonymousjoin for this thread.
     * @var string
     */
    private $disableanonymousjoin;

    /**
     * Constructor.
     * @param mixed[] $raw
     */
    public function __construct(array $data)
    {
        $this->mapPropertiesFromArray($data);
    }


    /**
     * Get the deliveryReceipt for this thread.
     *
     * @return  string
     */
    public function getDeliveryReceipt()
    {
        return $this->deliveryReceipt;
    }

    /**
     * Set the deliveryReceipt for this thread.
     *
     * @param  string  $deliveryReceipt  The deliveryReceipt for this thread.
     *
     * @return  self
     */
    public function setDeliveryReceipt(string $deliveryReceipt)
    {
        $this->deliveryReceipt = $deliveryReceipt;

        return $this;
    }

    /**
     * Get the consumptionhorizonpublished for this thread.
     *
     * @return  string
     */
    public function getConsumptionhorizonpublished()
    {
        return $this->consumptionhorizonpublished;
    }

    /**
     * Set the consumptionhorizonpublished for this thread.
     *
     * @param  string  $consumptionhorizonpublished  The consumptionhorizonpublished for this thread.
     *
     * @return  self
     */
    public function setConsumptionhorizonpublished(string $consumptionhorizonpublished)
    {
        $this->consumptionhorizonpublished = $consumptionhorizonpublished;

        return $this;
    }

    /**
     * Get the lastimreceivedtime for this thread.
     *
     * @return  string
     */
    public function getLastimreceivedtime()
    {
        return $this->lastimreceivedtime;
    }

    /**
     * Set the lastimreceivedtime for this thread.
     *
     * @param  string  $lastimreceivedtime  The lastimreceivedtime for this thread.
     *
     * @return  self
     */
    public function setLastimreceivedtime(string $lastimreceivedtime)
    {
        $this->lastimreceivedtime = $lastimreceivedtime;

        return $this;
    }

    /**
     * Get the pinned for this thread.
     *
     * @return  string
     */
    public function getPinned()
    {
        return $this->pinned;
    }

    /**
     * Set the pinned for this thread.
     *
     * @param  string  $pinned  The pinned for this thread.
     *
     * @return  self
     */
    public function setPinned(string $pinned)
    {
        $this->pinned = $pinned;

        return $this;
    }

    /**
     * Get the isfollowed for this thread.
     *
     * @return  string
     */
    public function getIsfollowed()
    {
        return $this->isfollowed;
    }

    /**
     * Set the isfollowed for this thread.
     *
     * @param  string  $isfollowed  The isfollowed for this thread.
     *
     * @return  self
     */
    public function setIsfollowed(string $isfollowed)
    {
        $this->isfollowed = $isfollowed;

        return $this;
    }

    /**
     * Get the isemptyconversation for this thread.
     *
     * @return  string
     */
    public function getIsemptyconversation()
    {
        return $this->isemptyconversation;
    }

    /**
     * Set the isemptyconversation for this thread.
     *
     * @param  string  $isemptyconversation  The isemptyconversation for this thread.
     *
     * @return  self
     */
    public function setIsemptyconversation(string $isemptyconversation)
    {
        $this->isemptyconversation = $isemptyconversation;

        return $this;
    }

    /**
     * Get the favorite for this thread.
     *
     * @return  string
     */
    public function getFavorite()
    {
        return $this->favorite;
    }

    /**
     * Set the favorite for this thread.
     *
     * @param  string  $favorite  The favorite for this thread.
     *
     * @return  self
     */
    public function setFavorite(string $favorite)
    {
        $this->favorite = $favorite;

        return $this;
    }

    /**
     * Get the consumptionhorizon for this thread.
     *
     * @return  string
     */
    public function getConsumptionhorizon()
    {
        return $this->consumptionhorizon;
    }

    /**
     * Set the consumptionhorizon for this thread.
     *
     * @param  string  $consumptionhorizon  The consumptionhorizon for this thread.
     *
     * @return  self
     */
    public function setConsumptionhorizon(string $consumptionhorizon)
    {
        $this->consumptionhorizon = $consumptionhorizon;

        return $this;
    }

    /**
     * Get the topic for this thread.
     *
     * @return  string
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set the topic for this thread.
     *
     * @param  string  $topic  The topic for this thread.
     *
     * @return  self
     */
    public function setTopic(string $topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get the creatorcid for this thread.
     *
     * @return  string
     */
    public function getCreatorcid()
    {
        return $this->creatorcid;
    }

    /**
     * Set the creatorcid for this thread.
     *
     * @param  string  $creatorcid  The creatorcid for this thread.
     *
     * @return  self
     */
    public function setCreatorcid(string $creatorcid)
    {
        $this->creatorcid = $creatorcid;

        return $this;
    }

    /**
     * Get the moderatedthread for this thread.
     *
     * @return  string
     */
    public function getModeratedthread()
    {
        return $this->moderatedthread;
    }

    /**
     * Set the moderatedthread for this thread.
     *
     * @param  string  $moderatedthread  The moderatedthread for this thread.
     *
     * @return  self
     */
    public function setModeratedthread(string $moderatedthread)
    {
        $this->moderatedthread = $moderatedthread;

        return $this;
    }

    /**
     * Get the creator for this thread.
     *
     * @return  string
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set the creator for this thread.
     *
     * @param  string  $creator  The creator for this thread.
     *
     * @return  self
     */
    public function setCreator(string $creator)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get the createdat for this thread.
     *
     * @return  string
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * Set the createdat for this thread.
     *
     * @param  string  $createdat  The createdat for this thread.
     *
     * @return  self
     */
    public function setCreatedat(string $createdat)
    {
        $this->createdat = $createdat;

        return $this;
    }

    /**
     * Get the picture for this thread.
     *
     * @return  string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the picture for this thread.
     *
     * @param  string  $picture  The picture for this thread.
     *
     * @return  self
     */
    public function setPicture(string $picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get the historydisclosed for this thread.
     *
     * @return  string
     */
    public function getHistorydisclosed()
    {
        return $this->historydisclosed;
    }

    /**
     * Set the historydisclosed for this thread.
     *
     * @param  string  $historydisclosed  The historydisclosed for this thread.
     *
     * @return  self
     */
    public function setHistorydisclosed(string $historydisclosed)
    {
        $this->historydisclosed = $historydisclosed;

        return $this;
    }

    /**
     * Get the joiningenabled for this thread.
     *
     * @return  string
     */
    public function getJoiningenabled()
    {
        return $this->joiningenabled;
    }

    /**
     * Set the joiningenabled for this thread.
     *
     * @param  string  $joiningenabled  The joiningenabled for this thread.
     *
     * @return  self
     */
    public function setJoiningenabled(string $joiningenabled)
    {
        $this->joiningenabled = $joiningenabled;

        return $this;
    }

    /**
     * Get the capabilities for this thread.
     *
     * @return  string[]
     */
    public function getCapabilities()
    {
        return $this->capabilities;
    }

    /**
     * Set the capabilities for this thread.
     *
     * @param  string[]  $capabilities  The capabilities for this thread.
     *
     * @return  self
     */
    public function setCapabilities(array $capabilities)
    {
        $this->capabilities = $capabilities;

        return $this;
    }

    /**
     * Get the conversationstatusproperties for this thread.
     *
     * @return  string
     */
    public function getConversationstatusproperties()
    {
        return $this->conversationstatusproperties;
    }

    /**
     * Set the conversationstatusproperties for this thread.
     *
     * @param  string  $conversationstatusproperties  The conversationstatusproperties for this thread.
     *
     * @return  self
     */
    public function setConversationstatusproperties(string $conversationstatusproperties)
    {
        $this->conversationstatusproperties = $conversationstatusproperties;

        return $this;
    }

    /**
     * Get the conversationstatus for this thread.
     *
     * @return  string
     */
    public function getConversationstatus()
    {
        return $this->conversationstatus;
    }

    /**
     * Set the conversationstatus for this thread.
     *
     * @param  string  $conversationstatus  The conversationstatus for this thread.
     *
     * @return  self
     */
    public function setConversationstatus(string $conversationstatus)
    {
        $this->conversationstatus = $conversationstatus;

        return $this;
    }

    /**
     * Get the awareness_conversationLiveState for this thread.
     *
     * @return  string
     */
    public function getAwareness_conversationLiveState()
    {
        return $this->awareness_conversationLiveState;
    }

    /**
     * Set the awareness_conversationLiveState for this thread.
     *
     * @param  string  $awareness_conversationLiveState  The awareness_conversationLiveState for this thread.
     *
     * @return  self
     */
    public function setAwareness_conversationLiveState(string $awareness_conversationLiveState)
    {
        $this->awareness_conversationLiveState = $awareness_conversationLiveState;

        return $this;
    }

    /**
     * Get the subscription for this thread.
     *
     * @return  string
     */
    public function getSubscription()
    {
        return $this->subscription;
    }

    /**
     * Set the subscription for this thread.
     *
     * @param  string  $subscription  The subscription for this thread.
     *
     * @return  self
     */
    public function setSubscription(string $subscription)
    {
        $this->subscription = $subscription;

        return $this;
    }

    /**
     * Get the alerts for this thread.
     *
     * @return  string
     */
    public function getAlerts()
    {
        return $this->alerts;
    }

    /**
     * Set the alerts for this thread.
     *
     * @param  string  $alerts  The alerts for this thread.
     *
     * @return  self
     */
    public function setAlerts(string $alerts)
    {
        $this->alerts = $alerts;

        return $this;
    }

    /**
     * Get the disableanonymousjoin for this thread.
     *
     * @return  string
     */
    public function getDisableanonymousjoin()
    {
        return $this->disableanonymousjoin;
    }

    /**
     * Set the disableanonymousjoin for this thread.
     *
     * @param  string  $disableanonymousjoin  The disableanonymousjoin for this thread.
     *
     * @return  self
     */
    public function setDisableanonymousjoin(string $disableanonymousjoin)
    {
        $this->disableanonymousjoin = $disableanonymousjoin;

        return $this;
    }
}
