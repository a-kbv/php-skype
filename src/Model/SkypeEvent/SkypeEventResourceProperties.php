<?php

namespace Akbv\PhpSkype\Model\SkypeEvent;


/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SkypeEventResourceProperties extends \Akbv\PhpSkype\Model\Base
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
    private $consumptionHorizonPublished;

    /**
     * The lastimreceivedtime for this thread.
     * @var string
     */
    private $lastImReceivedTime;


    /**
     * The pinned for this thread.
     * @var string
     */
    private $pinned;

    /**
     * The isfollowed for this thread.
     * @var string
     */
    private $isFollowed;

    /**
     * The isemptyconversation for this thread.
     * @var string
     */
    private $isEmptyConversation;
    /**
     * The favorite for this thread.
     * @var string
     */
    private $favorite;

    /**
     * The consumptionhorizon for this thread.
     * @var string
     */
    private $consumptionHorizon;

    /**
     * The topic for this thread.
     * @var string
     */
    private $topic;

    /**
     * The creatorcid for this thread.
     * @var string
     */
    private $creatorCid;

    /**
     * The moderatedthread for this thread.
     * @var string
     */
    private $moderatedThread;

    /**
     * The creator for this thread.
     * @var string
     */
    private $creator;

    /**
     * The createdat for this thread.
     * @var string
     */
    private $createdAt;

    /**
     * The picture for this thread.
     * @var string
     */
    private $picture;

    /**
     * The historydisclosed for this thread.
     * @var string
     */
    private $historyDisclosed;

    /**
     * The joiningenabled for this thread.
     * @var string
     */
    private $joiningEnabled;

    /**
     * The capabilities for this thread.
     * @var string[]
     */
    private $capabilities;

    /**
     * The conversationstatusproperties for this thread.
     * @var string
     */
    private $conversationStatusProperties;

    /**
     * The conversationstatus for this thread.
     * @var string
     */
    private $conversationStatus;

    /**
     * The awareness_conversationLiveState for this thread.
     * @var string
     */
    private $awarenessConversationLiveState;

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
    private $disableAnonymousJoin;

    /**
      * Constructor
      *
      * @param mixed[] $raw The data to map to properties
      */
    public function __construct($raw)
    {
        $this->fromArray($raw);
    }

    public function toArray()
    {
        $data['deliveryReceipt'] = $this->deliveryReceipt;
        $data['consumptionhorizonpublished'] = $this->consumptionHorizonPublished;
        $data['lastimreceivedtime'] = $this->lastImReceivedTime;
        $data['pinned'] = $this->pinned;
        $data['isfollowed'] = $this->isFollowed;
        $data['isemptyconversation'] = $this->isEmptyConversation;
        $data['favorite'] = $this->favorite;
        $data['consumptionhorizon'] = $this->consumptionHorizon;
        $data['topic'] = $this->topic;
        $data['creatorcid'] = $this->creatorCid;
        $data['moderatedthread'] = $this->moderatedThread;
        $data['creator'] = $this->creator;
        $data['createdat'] = $this->createdAt;
        $data['picture'] = $this->picture;
        $data['historydisclosed'] = $this->historyDisclosed;
        $data['joiningenabled'] = $this->joiningEnabled;
        $data['capabilities'] = $this->capabilities;
        $data['conversationstatusproperties'] = $this->conversationStatusProperties;
        $data['conversationstatus'] = $this->conversationStatus;
        $data['awareness_conversationLiveState'] = $this->awarenessConversationLiveState;
        $data['subscription'] = $this->subscription;
        $data['alerts'] = $this->alerts;
        $data['disableanonymousjoin'] = $this->disableAnonymousJoin;

        return $data;
    }

    private function fromArray($raw)
    {
        if (!is_object($raw)) {
            $raw = (object) $raw;
        }
        $this->deliveryReceipt = !empty($raw->deliveryReceipt) ? $raw->deliveryReceipt : null;
        $this->consumptionHorizonPublished = !empty($raw->consumptionhorizonpublished) ? $raw->consumptionhorizonpublished : null;
        $this->lastImReceivedTime = !empty($raw->lastimreceivedtime) ? $raw->lastimreceivedtime : null;
        $this->pinned = !empty($raw->pinned) ? $raw->pinned : null;
        $this->isFollowed = !empty($raw->isfollowed) ? $raw->isfollowed : null;
        $this->isEmptyConversation = !empty($raw->isemptyconversation) ? $raw->isemptyconversation : null;
        $this->favorite = !empty($raw->favorite) ? $raw->favorite : null;
        $this->consumptionHorizon = !empty($raw->consumptionhorizon) ? $raw->consumptionhorizon : null;
        $this->topic = !empty($raw->topic) ? $raw->topic : null;
        $this->creatorCid = !empty($raw->creatorcid) ? $raw->creatorcid : null;
        $this->moderatedThread = !empty($raw->moderatedthread) ? $raw->moderatedthread : null;
        $this->creator = !empty($raw->creator) ? $raw->creator : null;
        $this->createdAt = !empty($raw->createdat) ? $raw->createdat : null;
        $this->picture = !empty($raw->picture) ? $raw->picture : null;
        $this->historyDisclosed = !empty($raw->historydisclosed) ? $raw->historydisclosed : null;
        $this->joiningEnabled = !empty($raw->joiningenabled) ? $raw->joiningenabled : null;
        $this->capabilities = !empty($raw->capabilities) ? $raw->capabilities : null;
        $this->conversationStatusProperties = !empty($raw->conversationstatusproperties) ? $raw->conversationstatusproperties : null;
        $this->conversationStatus = !empty($raw->conversationstatus) ? $raw->conversationstatus : null;
        $this->awarenessConversationLiveState = !empty($raw->awareness_conversationLiveState) ? $raw->awareness_conversationLiveState : null;
        $this->subscription = !empty($raw->subscription) ? $raw->subscription : null;
        $this->alerts = !empty($raw->alerts) ? $raw->alerts : null;
        $this->disableAnonymousJoin = !empty($raw->disableanonymousjoin) ? $raw->disableanonymousjoin : null;
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
    public function getConsumptionHorizonPublished()
    {
        return $this->consumptionHorizonPublished;
    }

    /**
     * Set the consumptionhorizonpublished for this thread.
     *
     * @param  string  $consumptionHorizonPublished  The consumptionhorizonpublished for this thread.
     *
     * @return  self
     */
    public function setConsumptionHorizonPublished(string $consumptionHorizonPublished)
    {
        $this->consumptionHorizonPublished = $consumptionHorizonPublished;

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
    public function getIsFollowed()
    {
        return $this->isFollowed;
    }

    /**
     * Set the isfollowed for this thread.
     *
     * @param  string  $isFollowed  The isfollowed for this thread.
     *
     * @return  self
     */
    public function setIsFollowed(string $isFollowed)
    {
        $this->isFollowed = $isFollowed;

        return $this;
    }

    /**
     * Get the isemptyconversation for this thread.
     *
     * @return  string
     */
    public function getIsEmptyConversation()
    {
        return $this->isEmptyConversation;
    }

    /**
     * Set the isemptyconversation for this thread.
     *
     * @param  string  $isEmptyConversation  The isemptyconversation for this thread.
     *
     * @return  self
     */
    public function setIsEmptyConversation(string $isEmptyConversation)
    {
        $this->isEmptyConversation = $isEmptyConversation;

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
    public function getConsumptionHorizon()
    {
        return $this->consumptionHorizon;
    }

    /**
     * Set the consumptionhorizon for this thread.
     *
     * @param  string  $consumptionHorizon  The consumptionhorizon for this thread.
     *
     * @return  self
     */
    public function setConsumptionHorizon(string $consumptionHorizon)
    {
        $this->consumptionHorizon = $consumptionHorizon;

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
    public function getCreatorCid()
    {
        return $this->creatorCid;
    }

    /**
     * Set the creatorcid for this thread.
     *
     * @param  string  $creatorCid  The creatorcid for this thread.
     *
     * @return  self
     */
    public function setCreatorCid(string $creatorCid)
    {
        $this->creatorCid = $creatorCid;

        return $this;
    }

    /**
     * Get the moderatedthread for this thread.
     *
     * @return  string
     */
    public function getModeratedThread()
    {
        return $this->moderatedThread;
    }

    /**
     * Set the moderatedthread for this thread.
     *
     * @param  string  $moderatedThread  The moderatedthread for this thread.
     *
     * @return  self
     */
    public function setModeratedThread(string $moderatedThread)
    {
        $this->moderatedThread = $moderatedThread;

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
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the createdat for this thread.
     *
     * @param  string  $createdAt  The createdat for this thread.
     *
     * @return  self
     */
    public function setCreatedAt(string $createdAt)
    {
        $this->createdAt = $createdAt;

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
    public function getHistoryDisclosed()
    {
        return $this->historyDisclosed;
    }

    /**
     * Set the historydisclosed for this thread.
     *
     * @param  string  $historyDisclosed  The historydisclosed for this thread.
     *
     * @return  self
     */
    public function setHistoryDisclosed(string $historyDisclosed)
    {
        $this->historyDisclosed = $historyDisclosed;

        return $this;
    }

    /**
     * Get the joiningenabled for this thread.
     *
     * @return  string
     */
    public function getJoiningEnabled()
    {
        return $this->joiningEnabled;
    }

    /**
     * Set the joiningenabled for this thread.
     *
     * @param  string  $joiningEnabled  The joiningenabled for this thread.
     *
     * @return  self
     */
    public function setJoiningEnabled(string $joiningEnabled)
    {
        $this->joiningEnabled = $joiningEnabled;

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
    public function getConversationStatusProperties()
    {
        return $this->conversationStatusProperties;
    }

    /**
     * Set the conversationstatusproperties for this thread.
     *
     * @param  string  $conversationStatusProperties  The conversationstatusproperties for this thread.
     *
     * @return  self
     */
    public function setConversationStatusProperties(string $conversationStatusProperties)
    {
        $this->conversationStatusProperties = $conversationStatusProperties;

        return $this;
    }

    /**
     * Get the conversationstatus for this thread.
     *
     * @return  string
     */
    public function getConversationStatus()
    {
        return $this->conversationStatus;
    }

    /**
     * Set the conversationstatus for this thread.
     *
     * @param  string  $conversationStatus  The conversationstatus for this thread.
     *
     * @return  self
     */
    public function setConversationStatus(string $conversationStatus)
    {
        $this->conversationStatus = $conversationStatus;

        return $this;
    }

    /**
     * Get the awareness_conversationLiveState for this thread.
     *
     * @return  string
     */
    public function getAwarenessConversationLiveState()
    {
        return $this->awarenessConversationLiveState;
    }

    /**
     * Set the awareness_conversationLiveState for this thread.
     *
     * @param  string  $awarenessConversationLiveState  The awareness_conversationLiveState for this thread.
     *
     * @return  self
     */
    public function setAwarenessConversationLiveState(string $awarenessConversationLiveState)
    {
        $this->awarenessConversationLiveState = $awarenessConversationLiveState;

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
    public function getDisableAnonymousJoin()
    {
        return $this->disableAnonymousJoin;
    }

    /**
     * Set the disableanonymousjoin for this thread.
     *
     * @param  string  $disableAnonymousJoin  The disableanonymousjoin for this thread.
     *
     * @return  self
     */
    public function setDisableAnonymousJoin(string $disableAnonymousJoin)
    {
        $this->disableAnonymousJoin = $disableAnonymousJoin;

        return $this;
    }
}
