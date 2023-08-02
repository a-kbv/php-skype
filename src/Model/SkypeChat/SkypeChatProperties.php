<?php

namespace Akbv\PhpSkype\Model\SkypeChat;
/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SkypeChatProperties extends \Akbv\PhpSkype\Model\Base
{
    /**
    * The consumer horizon published this conversation.
    * consumptionhorizonpublished
    * @var string
    */
    private $consumptionHorizonPublished;

    /**
     * The empty conversation this conversation.
     * isemptyconversation
     * @var string
     */
    private $isEmptyConversation;

    /**
     * The consumer horizon this conversation.
     * consumptionhorizon
     * @var string
     */
    private $consumptionHorizon;

    /**
     * The followed this conversation.
     * isfollowed
     * @var string
     */
    private $isFollowed;

    /**
     * The last im received time this conversation.
     * lastimreceivedtime
     * @var string
     */
    private $lastImReceivedTime;

    /**
     * The conversation status this conversation.
     * conversationstatus
     * @var string
     */
    private $conversationStatus;

    /**
     * The conversation status properties this conversation.
     * conversationstatusproperties
     * @var string
     */
    private $conversationStatusProperties;

    /**
     * The one to one thread id this conversation.
     * onetoonethreadid
     * @var string
     */
    private $oneToOneThreadId;

    /**
     * The conversation blocked this conversation.
     * conversationblocked
     * @var string
     */
    private $conversationBlocked;

    /**
     * The delivery receipt this conversation.
     * @var string
     */
    private $deliveryReceipt;

    /**
     * The pinned this conversation.
     * @var string
     */
    private $pinned;

    /**
     * The favorite this conversation.
     * @var string
     */
    private $favorite;

    /**
     * The conversation is blocked this conversation.
     * conversationisblocked
     * @var string
     */
    private $conversationIsBlocked;

    /**
     * The cleared at this conversation.
     * clearedat
     * @var string
     */
    private $clearedAt;

    /**
     * The processed cleared at this conversation.
     * @var string
     */
    private $processedClearedAt;

    /**
     * The color this conversation.
     * @var string
     */
    private $color;

    public function __construct($raw)
    {
        $this->fromArray($raw);
    }

    public function toArray()
    {
        $conversationData['consumptionhorizonpublished'] = $this->consumptionHorizonPublished;
        $conversationData['isemptyconversation'] = $this->isEmptyConversation;
        $conversationData['consumptionhorizon'] = $this->consumptionHorizon;
        $conversationData['isfollowed'] = $this->isFollowed;
        $conversationData['lastimreceivedtime'] = $this->lastImReceivedTime;
        $conversationData['conversationstatus'] = $this->conversationStatus;
        $conversationData['conversationstatusproperties'] = $this->conversationStatusProperties;
        $conversationData['onetoonethreadid'] = $this->oneToOneThreadId;
        $conversationData['conversationblocked'] = $this->conversationBlocked;
        $conversationData['deliveryReceipt'] = $this->deliveryReceipt;
        $conversationData['pinned'] = $this->pinned;
        $conversationData['favorite'] = $this->favorite;
        $conversationData['conversationisblocked'] = $this->conversationIsBlocked;
        $conversationData['clearedat'] = $this->clearedAt;
        $conversationData['processedclearedat'] = $this->processedClearedAt;
        $conversationData['color'] = $this->color;

        return $conversationData;
    }

    private function fromArray($raw)
    {
        if (!is_object($raw)) {
            $raw = (object) $raw;
        }
        $this->consumptionHorizonPublished = !empty($raw->consumptionhorizonpublished) ? $raw->consumptionhorizonpublished : null;
        $this->isEmptyConversation = !empty($raw->isemptyconversation) ? $raw->isemptyconversation : null;
        $this->consumptionHorizon = !empty($raw->consumptionhorizon) ? $raw->consumptionhorizon : null;
        $this->isFollowed = !empty($raw->isfollowed) ? $raw->isfollowed : null;
        $this->lastImReceivedTime = !empty($raw->lastimreceivedtime) ? $raw->lastimreceivedtime : null;
        $this->conversationStatus = !empty($raw->conversationstatus) ? $raw->conversationstatus : null;
        $this->conversationStatusProperties = !empty($raw->conversationstatusproperties) ? $raw->conversationstatusproperties : null;
        $this->oneToOneThreadId = !empty($raw->onetoonethreadid) ? $raw->onetoonethreadid : null;
        $this->conversationBlocked = !empty($raw->conversationblocked) ? $raw->conversationblocked : null;
        $this->deliveryReceipt = !empty($raw->deliveryReceipt) ? $raw->deliveryReceipt : null;
        $this->pinned = !empty($raw->pinned) ? $raw->pinned : null;
        $this->favorite = !empty($raw->favorite) ? $raw->favorite : null;
        $this->conversationIsBlocked = !empty($raw->conversationisblocked) ? $raw->conversationisblocked : null;
        $this->clearedAt = !empty($raw->clearedat) ? $raw->clearedat : null;
        $this->processedClearedAt = !empty($raw->processedclearedat) ? $raw->processedclearedat : null;
        $this->color = !empty($raw->color) ? $raw->color : null;
    }



    /**
     * Get consumptionhorizonpublished
     *
     * @return  string
     */
    public function getConsumptionHorizonPublished()
    {
        return $this->consumptionHorizonPublished;
    }

    /**
     * Set consumptionhorizonpublished
     *
     * @param  string  $consumptionHorizonPublished  consumptionhorizonpublished
     *
     * @return  self
     */
    public function setConsumptionHorizonPublished(string $consumptionHorizonPublished)
    {
        $this->consumptionHorizonPublished = $consumptionHorizonPublished;

        return $this;
    }

    /**
     * Get isemptyconversation
     *
     * @return  string
     */
    public function getIsEmptyConversation()
    {
        return $this->isEmptyConversation;
    }

    /**
     * Set isemptyconversation
     *
     * @param  string  $isEmptyConversation  isemptyconversation
     *
     * @return  self
     */
    public function setIsEmptyConversation(string $isEmptyConversation)
    {
        $this->isEmptyConversation = $isEmptyConversation;

        return $this;
    }

    /**
     * Get consumptionhorizon
     *
     * @return  string
     */
    public function getConsumptionHorizon()
    {
        return $this->consumptionHorizon;
    }

    /**
     * Set consumptionhorizon
     *
     * @param  string  $consumptionHorizon  consumptionhorizon
     *
     * @return  self
     */
    public function setConsumptionHorizon(string $consumptionHorizon)
    {
        $this->consumptionHorizon = $consumptionHorizon;

        return $this;
    }

    /**
     * Get isfollowed
     *
     * @return  string
     */
    public function getIsFollowed()
    {
        return $this->isFollowed;
    }

    /**
     * Set isfollowed
     *
     * @param  string  $isFollowed  isfollowed
     *
     * @return  self
     */
    public function setIsFollowed(string $isFollowed)
    {
        $this->isFollowed = $isFollowed;

        return $this;
    }

    /**
     * Get lastimreceivedtime
     *
     * @return  string
     */
    public function getLastImReceivedTime()
    {
        return $this->lastImReceivedTime;
    }

    /**
     * Set lastimreceivedtime
     *
     * @param  string  $lastImReceivedTime  lastimreceivedtime
     *
     * @return  self
     */
    public function setLastImReceivedTime(string $lastImReceivedTime)
    {
        $this->lastImReceivedTime = $lastImReceivedTime;

        return $this;
    }

    /**
     * Get conversationstatus
     *
     * @return  string
     */
    public function getConversationStatus()
    {
        return $this->conversationStatus;
    }

    /**
     * Set conversationstatus
     *
     * @param  string  $conversationStatus  conversationstatus
     *
     * @return  self
     */
    public function setConversationStatus(string $conversationStatus)
    {
        $this->conversationStatus = $conversationStatus;

        return $this;
    }

    /**
     * Get conversationstatusproperties
     *
     * @return  string
     */
    public function getConversationStatusProperties()
    {
        return $this->conversationStatusProperties;
    }

    /**
     * Set conversationstatusproperties
     *
     * @param  string  $conversationStatusProperties  conversationstatusproperties
     *
     * @return  self
     */
    public function setConversationStatusProperties(string $conversationStatusProperties)
    {
        $this->conversationStatusProperties = $conversationStatusProperties;

        return $this;
    }

    /**
     * Get onetoonethreadid
     *
     * @return  string
     */
    public function getOneToOneThreadId()
    {
        return $this->oneToOneThreadId;
    }

    /**
     * Set onetoonethreadid
     *
     * @param  string  $oneToOneThreadId  onetoonethreadid
     *
     * @return  self
     */
    public function setOneToOneThreadId(string $oneToOneThreadId)
    {
        $this->oneToOneThreadId = $oneToOneThreadId;

        return $this;
    }

    /**
     * Get conversationblocked
     *
     * @return  string
     */
    public function getConversationBlocked()
    {
        return $this->conversationBlocked;
    }

    /**
     * Set conversationblocked
     *
     * @param  string  $conversationBlocked  conversationblocked
     *
     * @return  self
     */
    public function setConversationBlocked(string $conversationBlocked)
    {
        $this->conversationBlocked = $conversationBlocked;

        return $this;
    }

    /**
     * Get the delivery receipt this conversation.
     *
     * @return  string
     */
    public function getDeliveryReceipt()
    {
        return $this->deliveryReceipt;
    }

    /**
     * Set the delivery receipt this conversation.
     *
     * @param  string  $deliveryReceipt  The delivery receipt this conversation.
     *
     * @return  self
     */
    public function setDeliveryReceipt(string $deliveryReceipt)
    {
        $this->deliveryReceipt = $deliveryReceipt;

        return $this;
    }

    /**
     * Get the pinned this conversation.
     *
     * @return  string
     */
    public function getPinned()
    {
        return $this->pinned;
    }

    /**
     * Set the pinned this conversation.
     *
     * @param  string  $pinned  The pinned this conversation.
     *
     * @return  self
     */
    public function setPinned(string $pinned)
    {
        $this->pinned = $pinned;

        return $this;
    }

    /**
     * Get the favorite this conversation.
     *
     * @return  string
     */
    public function getFavorite()
    {
        return $this->favorite;
    }

    /**
     * Set the favorite this conversation.
     *
     * @param  string  $favorite  The favorite this conversation.
     *
     * @return  self
     */
    public function setFavorite(string $favorite)
    {
        $this->favorite = $favorite;

        return $this;
    }

    /**
     * Get conversationisblocked
     *
     * @return  string
     */
    public function getConversationIsBlocked()
    {
        return $this->conversationIsBlocked;
    }

    /**
     * Set conversationisblocked
     *
     * @param  string  $conversationIsBlocked  conversationisblocked
     *
     * @return  self
     */
    public function setConversationIsBlocked(string $conversationIsBlocked)
    {
        $this->conversationIsBlocked = $conversationIsBlocked;

        return $this;
    }

    /**
     * Get clearedat
     *
     * @return  string
     */
    public function getClearedAt()
    {
        return $this->clearedAt;
    }

    /**
     * Set clearedat
     *
     * @param  string  $clearedAt  clearedat
     *
     * @return  self
     */
    public function setClearedAt(string $clearedAt)
    {
        $this->clearedAt = $clearedAt;

        return $this;
    }

    /**
     * Get the processed cleared at this conversation.
     *
     * @return  string
     */
    public function getProcessedClearedAt()
    {
        return $this->processedClearedAt;
    }

    /**
     * Set the processed cleared at this conversation.
     *
     * @param  string  $processedClearedAt  The processed cleared at this conversation.
     *
     * @return  self
     */
    public function setProcessedClearedAt(string $processedClearedAt)
    {
        $this->processedClearedAt = $processedClearedAt;

        return $this;
    }

    /**
     * Get the color this conversation.
     *
     * @return  string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the color this conversation.
     *
     * @param  string  $color  The color this conversation.
     *
     * @return  self
     */
    public function setColor(string $color)
    {
        $this->color = $color;

        return $this;
    }
}
