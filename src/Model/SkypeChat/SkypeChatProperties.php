<?php

namespace Akbv\PhpSkype\Model\SkypeChat;
/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SkypeChatProperties
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
     * Get isemptyconversation
     *
     * @return  string
     */
    public function getIsEmptyConversation()
    {
        return $this->isEmptyConversation;
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
     * Get isfollowed
     *
     * @return  string
     */
    public function getIsFollowed()
    {
        return $this->isFollowed;
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
     * Get conversationstatus
     *
     * @return  string
     */
    public function getConversationStatus()
    {
        return $this->conversationStatus;
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
     * Get onetoonethreadid
     *
     * @return  string
     */
    public function getOneToOneThreadId()
    {
        return $this->oneToOneThreadId;
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
     * Get the delivery receipt this conversation.
     *
     * @return  string
     */
    public function getDeliveryReceipt()
    {
        return $this->deliveryReceipt;
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
     * Get the favorite this conversation.
     *
     * @return  string
     */
    public function getFavorite()
    {
        return $this->favorite;
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
     * Get clearedat
     *
     * @return  string
     */
    public function getClearedAt()
    {
        return $this->clearedAt;
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
}
