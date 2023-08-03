<?php

namespace Akbv\PhpSkype\Model\SkypeMessage;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SkypeMessage extends \Akbv\PhpSkype\Model\Base
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
        $this->from = !empty($raw->from) ? \Akbv\PhpSkype\Util\Util::userUrlToId($raw->from) : null;
        $this->ackRequired = !empty($raw->ackrequired) ? $raw->ackrequired : null;
        $this->counterPartyMessageId = !empty($raw->counterpartymessageid) ? $raw->counterpartymessageid : null;
        $this->imDisplayName = !empty($raw->imdisplayname) ? $raw->imdisplayname : null;
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
     * Set unique identifier for a message.
     *
     * @param  string  $id  Unique identifier for a message.
     *
     * @return  self
     */
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
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
     * Set originalarrivaltime
     *
     * @param  string  $originalArrivalTime  originalarrivaltime
     *
     * @return  self
     */
    public function setOriginalArrivalTime(string $originalArrivalTime)
    {
        $this->originalArrivalTime = $originalArrivalTime;

        return $this;
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
     * Set messagetype
     *
     * @param  string  $messageType  messagetype
     *
     * @return  self
     */
    public function setMessageType(string $messageType)
    {
        $this->messageType = $messageType;

        return $this;
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
     * Set the version of the message.
     *
     * @param  string  $version  The version of the message.
     *
     * @return  self
     */
    public function setVersion(string $version)
    {
        $this->version = $version;

        return $this;
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
     * Set composetime
     *
     * @param  string  $composeTime  composetime
     *
     * @return  self
     */
    public function setComposeTime(string $composeTime)
    {
        $this->composeTime = $composeTime;

        return $this;
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
     * Set clientmessageid
     *
     * @param  string  $clientMessageId  clientmessageid
     *
     * @return  self
     */
    public function setClientMessageId(string $clientMessageId)
    {
        $this->clientMessageId = $clientMessageId;

        return $this;
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
     * Set skypeeditedid
     *
     * @param  string  $skypeEditedId  skypeeditedid
     *
     * @return  self
     */
    public function setSkypeEditedId(string $skypeEditedId)
    {
        $this->skypeEditedId = $skypeEditedId;

        return $this;
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
     * Set the conversation link.
     *
     * @param  string  $conversationLink  The conversation link.
     *
     * @return  self
     */
    public function setConversationLink(string $conversationLink)
    {
        $this->conversationLink = $conversationLink;

        return $this;
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
     * Set properties.
     *
     * @param  string[]  $properties  Properties.
     *
     * @return  self
     */
    public function setProperties(array $properties)
    {
        $this->properties = $properties;

        return $this;
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
     * Set the content of the message.
     *
     * @param  string  $content  The content of the message.
     *
     * @return  self
     */
    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
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
     * Set the type of the message.
     *
     * @param  string  $type  The type of the message.
     *
     * @return  self
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get imdisplayname sender display name
     *
     * @return  string
     */
    public function getImDisplayName()
    {
        return $this->imDisplayName;
    }

    /**
     * Set imdisplayname sender display name
     *
     * @param  string  $imDisplayName  imdisplayname sender display name
     *
     * @return  self
     */
    public function setImDisplayName(string $imDisplayName)
    {
        $this->imDisplayName = $imDisplayName;

        return $this;
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
     * Set conversationid
     *
     * @param  string  $conversationId  conversationid
     *
     * @return  self
     */
    public function setConversationId(string $conversationId)
    {
        $this->conversationId = $conversationId;

        return $this;
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
     * Set the sender of the message.
     *
     * @param  string  $from  The sender of the message.
     *
     * @return  self
     */
    public function setFrom(string $from)
    {
        $this->from = $from;

        return $this;
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
     * Set ackrequired
     *
     * @param  string  $ackRequired  ackrequired
     *
     * @return  self
     */
    public function setAckRequired(string $ackRequired)
    {
        $this->ackRequired = $ackRequired;

        return $this;
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
     * Set counterpartymessageid
     *
     * @param  string  $counterPartyMessageId  counterpartymessageid
     *
     * @return  self
     */
    public function setCounterPartyMessageId(string $counterPartyMessageId)
    {
        $this->counterPartyMessageId = $counterPartyMessageId;

        return $this;
    }
}
