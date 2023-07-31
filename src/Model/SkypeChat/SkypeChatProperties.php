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
}
