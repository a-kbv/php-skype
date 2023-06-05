<?php

namespace Akbv\PhpSkype\Models\RawConversation;

/**
 * A raw conversation model.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class Properties extends \Akbv\PhpSkype\Models\Base
{
    /**
     * The consumer horizon published this conversation.
     * @var string
     */
    private $consumptionhorizonpublished;

    /**
     * The empty conversation this conversation.
     * @var string
     */
    private $isemptyconversation;

    /**
     * The consumer horizon this conversation.
     * @var string
     */
    private $consumptionhorizon;

    /**
     * The followed this conversation.
     * @var string
     */
    private $isfollowed;

    /**
     * The last im received time this conversation.
     * @var string
     */
    private $lastimreceivedtime;

    /**
     * The conversation status this conversation.
     * @var string
     */
    private $conversationstatus;

    /**
     * The conversation status properties this conversation.
     * @var string
     */
    private $conversationstatusproperties;

    /**
     * The one to one thread id this conversation.
     * @var string
     */
    private $onetoonethreadid;

    /**
     * The conversation blocked this conversation.
     * @var string
     */
    private $conversationblocked;

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
     * @var string
     */
    private $conversationisblocked;

    /**
     * The cleared at this conversation.
     * @var string
     */
    private $clearedat;

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

    /**
     * Constructor.
     * @param mixed[] $data
     */
    public function __construct(array $data)
    {
        $this->mapPropertiesFromArray($data);
        $this->jsonSerialize();
    }


    /**
     * Get the consumer horizon published this conversation.
     *
     * @return  string
     */
    public function getConsumptionhorizonpublished()
    {
        return $this->consumptionhorizonpublished;
    }

    /**
     * Set the consumer horizon published this conversation.
     *
     * @param  string  $consumptionhorizonpublished  The consumer horizon published this conversation.
     *
     * @return  self
     */
    public function setConsumptionhorizonpublished(string $consumptionhorizonpublished)
    {
        $this->consumptionhorizonpublished = $consumptionhorizonpublished;

        return $this;
    }

    /**
     * Get the empty conversation this conversation.
     *
     * @return  string
     */
    public function getIsemptyconversation()
    {
        return $this->isemptyconversation;
    }

    /**
     * Set the empty conversation this conversation.
     *
     * @param  string  $isemptyconversation  The empty conversation this conversation.
     *
     * @return  self
     */
    public function setIsemptyconversation(string $isemptyconversation)
    {
        $this->isemptyconversation = $isemptyconversation;

        return $this;
    }

    /**
     * Get the consumer horizon this conversation.
     *
     * @return  string
     */
    public function getConsumptionhorizon()
    {
        return $this->consumptionhorizon;
    }

    /**
     * Set the consumer horizon this conversation.
     *
     * @param  string  $consumptionhorizon  The consumer horizon this conversation.
     *
     * @return  self
     */
    public function setConsumptionhorizon(string $consumptionhorizon)
    {
        $this->consumptionhorizon = $consumptionhorizon;

        return $this;
    }

    /**
     * Get the followed this conversation.
     *
     * @return  string
     */
    public function getIsfollowed()
    {
        return $this->isfollowed;
    }

    /**
     * Set the followed this conversation.
     *
     * @param  string  $isfollowed  The followed this conversation.
     *
     * @return  self
     */
    public function setIsfollowed(string $isfollowed)
    {
        $this->isfollowed = $isfollowed;

        return $this;
    }

    /**
     * Get the last im received time this conversation.
     *
     * @return  string
     */
    public function getLastimreceivedtime()
    {
        return $this->lastimreceivedtime;
    }

    /**
     * Set the last im received time this conversation.
     *
     * @param  string  $lastimreceivedtime  The last im received time this conversation.
     *
     * @return  self
     */
    public function setLastimreceivedtime(string $lastimreceivedtime)
    {
        $this->lastimreceivedtime = $lastimreceivedtime;

        return $this;
    }

    /**
     * Get the conversation status this conversation.
     *
     * @return  string
     */
    public function getConversationstatus()
    {
        return $this->conversationstatus;
    }

    /**
     * Set the conversation status this conversation.
     *
     * @param  string  $conversationstatus  The conversation status this conversation.
     *
     * @return  self
     */
    public function setConversationstatus(string $conversationstatus)
    {
        $this->conversationstatus = $conversationstatus;

        return $this;
    }

    /**
     * Get the conversation status properties this conversation.
     *
     * @return  string
     */
    public function getConversationstatusproperties()
    {
        return $this->conversationstatusproperties;
    }

    /**
     * Set the conversation status properties this conversation.
     *
     * @param  string  $conversationstatusproperties  The conversation status properties this conversation.
     *
     * @return  self
     */
    public function setConversationstatusproperties(string $conversationstatusproperties)
    {
        $this->conversationstatusproperties = $conversationstatusproperties;

        return $this;
    }

    /**
     * Get the one to one thread id this conversation.
     *
     * @return  string
     */
    public function getOnetoonethreadid()
    {
        return $this->onetoonethreadid;
    }

    /**
     * Set the one to one thread id this conversation.
     *
     * @param  string  $onetoonethreadid  The one to one thread id this conversation.
     *
     * @return  self
     */
    public function setOnetoonethreadid(string $onetoonethreadid)
    {
        $this->onetoonethreadid = $onetoonethreadid;

        return $this;
    }

    /**
     * Get the conversation blocked this conversation.
     *
     * @return  string
     */
    public function getConversationblocked()
    {
        return $this->conversationblocked;
    }

    /**
     * Set the conversation blocked this conversation.
     *
     * @param  string  $conversationblocked  The conversation blocked this conversation.
     *
     * @return  self
     */
    public function setConversationblocked(string $conversationblocked)
    {
        $this->conversationblocked = $conversationblocked;

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
     * Get the conversation is blocked this conversation.
     *
     * @return  string
     */
    public function getConversationisblocked()
    {
        return $this->conversationisblocked;
    }

    /**
     * Set the conversation is blocked this conversation.
     *
     * @param  string  $conversationisblocked  The conversation is blocked this conversation.
     *
     * @return  self
     */
    public function setConversationisblocked(string $conversationisblocked)
    {
        $this->conversationisblocked = $conversationisblocked;

        return $this;
    }

    /**
     * Get the cleared at this conversation.
     *
     * @return  string
     */
    public function getClearedat()
    {
        return $this->clearedat;
    }

    /**
     * Set the cleared at this conversation.
     *
     * @param  string  $clearedat  The cleared at this conversation.
     *
     * @return  self
     */
    public function setClearedat(string $clearedat)
    {
        $this->clearedat = $clearedat;

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
