<?php

namespace Akbv\PhpSkype\Model\SkypeMessage;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SkypeMessage
{
    /**
    * Unique identifier for a message.
    * @var string
    */
    private $id;

    /**
     * The time at which the message was originally sent.
     * originalarrivaltime
     * @var string
     */
    private $originalArrivalTime;

    /**
     * The type of message.
     * messagetype
     * @var string
     */
    private $messageType;

    /**
     * The version of the message.
     * @var string
     */
    private $version;

    /**
     * The time at which the message was composed.
     * composetime
     * @var string
     */
    private $composeTime;

    /**
     * The client message identifier.
     * clientmessageid
     * @var string
     */
    private $clientMessageId;

    /**
     * @var string
     * skypeeditedid
     */
    private $skypeEditedId;

    /**
     * The conversation link.
     * @var string
     */
    private $conversationLink;

    /**
     * Properties.
     * @var string[]
     */
    private $properties;

    /**
     * The content of the message.
     * @var string
     */
    private $content;

    /**
     * The type of the message.
     * @var string
     */
    private $type;

    /**
     * imdisplayname sender display name
     * @var string
     */
    private $imDisplayName;

    /**
     * The conversation identifier.
     * conversationid
     * @var string
     */
    private $conversationId;

    /**
     * The sender of the message.
     * @var string
     */
    private $from;

    /**
     * The acknowledgement url of the message.
     * ackrequired
     * @var string
     */
    private $ackRequired;

    /**
     * The message identifier of the counterpart.
     * counterpartymessageid
     * @var string
     */
    private $counterPartyMessageId;

    public function __construct($raw)
    {
        $this->fromArray($raw);
    }

    public function toArray()
    {
        $data['id'] = $this->id;
        $data['originalarrivaltime'] = $this->originalArrivalTime;
        $data['messagetype'] = $this->messageType;
        $data['version'] = $this->version;
        $data['composetime'] = $this->composeTime;
        $data['clientmessageid'] = $this->clientMessageId;
        $data['skypeeditedid'] = $this->skypeEditedId;
        $data['conversationLink'] = $this->conversationLink;
        $data['properties'] = $this->properties;
        $data['content'] = $this->content;
        $data['type'] = $this->type;
        $data['conversationid'] = $this->conversationId;
        $data['from'] = $this->from;
        $data['ackrequired'] = $this->ackRequired;
        $data['counterpartymessageid'] = $this->counterPartyMessageId;
        $data['imdisplayname'] = $this->imDisplayName;
        return $data;
    }

    private function fromArray($raw)
    {
        if (!is_object($raw)) {
            $raw = (object) $raw;
        }
        $this->id = !empty($raw->id) ? $raw->id : null;
        $this->originalArrivalTime = !empty($raw->originalarrivaltime) ? $raw->originalarrivaltime : null;
        $this->messageType = !empty($raw->messagetype) ? $raw->messagetype : null;
        $this->version = !empty($raw->version) ? $raw->version : null;
        $this->composeTime = !empty($raw->composetime) ? $raw->composetime : null;
        $this->clientMessageId = !empty($raw->clientmessageid) ? $raw->clientmessageid : null;
        $this->skypeEditedId = !empty($raw->skypeeditedid) ? $raw->skypeeditedid : null;
        $this->conversationLink = !empty($raw->conversationLink) ? $raw->conversationLink : null;
        $this->properties = !empty($raw->properties) ? $raw->properties : null;
        $this->content = !empty($raw->content) ? $raw->content : null;
        $this->type = !empty($raw->type) ? $raw->type : null;
        $this->conversationId = !empty($raw->conversationid) ? $raw->conversationid : null;
        $this->from = !empty($raw->from) ? $raw->from : null;
        $this->ackRequired = !empty($raw->ackrequired) ? $raw->ackrequired : null;
        $this->counterPartyMessageId = !empty($raw->counterpartymessageid) ? $raw->counterpartymessageid : null;
        $this->imDisplayName = !empty($raw->imdisplayname) ? $raw->imdisplayname : null;
    }

    public function setDeleted()
    {
        $this->content = "";
    }


    /**
     * Get unique identifier for a message.
     *
     * @return  string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get originalarrivaltime
     *
     * @return  string
     */
    public function getOriginalArrivalTime()
    {
        return $this->originalArrivalTime;
    }

    /**
     * Get messagetype
     *
     * @return  string
     */
    public function getMessageType()
    {
        return $this->messageType;
    }

    /**
     * Get the version of the message.
     *
     * @return  string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Get composetime
     *
     * @return  string
     */
    public function getComposeTime()
    {
        return $this->composeTime;
    }

    /**
     * Get clientmessageid
     *
     * @return  string
     */
    public function getClientMessageId()
    {
        return $this->clientMessageId;
    }

    /**
     * Get skypeeditedid
     *
     * @return  string
     */
    public function getSkypeEditedId()
    {
        return $this->skypeEditedId;
    }

    /**
     * Get the conversation link.
     *
     * @return  string
     */
    public function getConversationLink()
    {
        return $this->conversationLink;
    }

    /**
     * Get properties.
     *
     * @return  string[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Get the content of the message.
     *
     * @return  string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get the type of the message.
     *
     * @return  string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get conversationid
     *
     * @return  string
     */
    public function getConversationId()
    {
        return $this->conversationId;
    }

    /**
     * Get the sender of the message.
     *
     * @return  string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Get ackrequired
     *
     * @return  string
     */
    public function getAckRequired()
    {
        return $this->ackRequired;
    }

    /**
     * Get counterpartymessageid
     *
     * @return  string
     */
    public function getCounterPartyMessageId()
    {
        return $this->counterPartyMessageId;
    }

    /**
     * Get imdisplayname sender display name
     */
    public function getImDisplayName()
    {
        return $this->imDisplayName;
    }
}
