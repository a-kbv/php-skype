<?php

namespace Akbv\PhpSkype\Models;

/**
 * A message either sent or received in a conversation.
 * An edit is represented by a follow-up message with the same property `clientId`, which replaces the earlier message.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class Message extends Base
{
    /**
     * Unique identifier for a message.
     * @var string
     */
    private $id;

    /**
     * The time at which the message was originally sent.
     * @var string
     */
    private $originalarrivaltime;

    /**
     * The type of message.
     * @var string
     */
    private $messagetype;

    /**
     * The version of the message.
     * @var string
     */
    private $version;

    /**
     * The time at which the message was composed.
     * @var string
     */
    private $composetime;

    /**
     * The client message identifier.
     * @var string
     */
    private $clientmessageid;

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
     * The conversation identifier.
     * @var string
     */
    private $conversationid;

    /**
     * The sender of the message.
     * @var string
     */
    private $from;

    /**
     * The acknowledgement url of the message.
     * @var string
     */
    private $ackrequired;

    /**
     * The message identifier of the counterpart.
     * @var string
     */
    private $counterpartymessageid;

    /**
     * The display name of the IM.
     * @var string
     */
    private $imdisplayname;

    /**
     * The origin context identifier.
     * @var string
     */
    private $origincontextid;

    /**
     * The thread topic.
     * @var string
     */
    private $threadtopic;

    /**
     * The content type.
     * @var string
     */
    private $contenttype;

    /**
     * The MLS epoch.
     * @var string
     */
    private $mlsEpoch;

    /**
     * The active status.
     * @var string
     */
    private $isactive;

    /**
     * Constructor.
     * @param mixed[] $data
     */
    public function __construct(array $data)
    {
        $this->mapPropertiesFromArray($data);
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
     * Get the time at which the message was originally sent.
     *
     * @return  string
     */
    public function getOriginalarrivaltime()
    {
        return $this->originalarrivaltime;
    }

    /**
     * Set the time at which the message was originally sent.
     *
     * @param  string  $originalarrivaltime  The time at which the message was originally sent.
     *
     * @return  self
     */
    public function setOriginalarrivaltime(string $originalarrivaltime)
    {
        $this->originalarrivaltime = $originalarrivaltime;

        return $this;
    }

    /**
     * Get the type of message.
     *
     * @return  string
     */
    public function getMessagetype()
    {
        return $this->messagetype;
    }

    /**
     * Set the type of message.
     *
     * @param  string  $messagetype  The type of message.
     *
     * @return  self
     */
    public function setMessagetype(string $messagetype)
    {
        $this->messagetype = $messagetype;

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
     * Get the time at which the message was composed.
     *
     * @return  string
     */
    public function getComposetime()
    {
        return $this->composetime;
    }

    /**
     * Set the time at which the message was composed.
     *
     * @param  string  $composetime  The time at which the message was composed.
     *
     * @return  self
     */
    public function setComposetime(string $composetime)
    {
        $this->composetime = $composetime;

        return $this;
    }

    /**
     * Get the client message identifier.
     *
     * @return  string
     */
    public function getClientmessageid()
    {
        return $this->clientmessageid;
    }

    /**
     * Set the client message identifier.
     *
     * @param  string  $clientmessageid  The client message identifier.
     *
     * @return  self
     */
    public function setClientmessageid(string $clientmessageid)
    {
        $this->clientmessageid = $clientmessageid;

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
     * Get the conversation identifier.
     *
     * @return  string
     */
    public function getConversationid()
    {
        return $this->conversationid;
    }

    /**
     * Set the conversation identifier.
     *
     * @param  string  $conversationid  The conversation identifier.
     *
     * @return  self
     */
    public function setConversationid(string $conversationid)
    {
        $this->conversationid = $conversationid;

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
     * Get properties.
     *
     * @return  mixed[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Set properties.
     *
     * @param  mixed[]  $properties  Properties.
     *
     * @return  self
     */
    public function setProperties(array $properties)
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * Get the acknowledgement url of the message.
     *
     * @return  string
     */
    public function getAckrequired()
    {
        return $this->ackrequired;
    }

    /**
     * Set the acknowledgement url of the message.
     *
     * @param  string  $ackrequired  The acknowledgement url of the message.
     *
     * @return  self
     */
    public function setAckrequired(string $ackrequired)
    {
        $this->ackrequired = $ackrequired;

        return $this;
    }

    /**
     * Get the message identifier of the counterpart.
     *
     * @return  string
     */
    public function getCounterpartymessageid()
    {
        return $this->counterpartymessageid;
    }

    /**
     * Set the message identifier of the counterpart.
     *
     * @param  string  $counterpartymessageid  The message identifier of the counterpart.
     *
     * @return  self
     */
    public function setCounterpartymessageid(string $counterpartymessageid)
    {
        $this->counterpartymessageid = $counterpartymessageid;

        return $this;
    }

    /**
     * Get the display name of the IM.
     *
     * @return  string
     */
    public function getImdisplayname()
    {
        return $this->imdisplayname;
    }

    /**
     * Set the display name of the IM.
     *
     * @param  string  $imdisplayname  The display name of the IM.
     *
     * @return  self
     */
    public function setImdisplayname(string $imdisplayname)
    {
        $this->imdisplayname = $imdisplayname;

        return $this;
    }

    /**
     * Get the origin context identifier.
     *
     * @return  string
     */
    public function getOrigincontextid()
    {
        return $this->origincontextid;
    }

    /**
     * Set the origin context identifier.
     *
     * @param  string  $origincontextid  The origin context identifier.
     *
     * @return  self
     */
    public function setOrigincontextid(string $origincontextid)
    {
        $this->origincontextid = $origincontextid;

        return $this;
    }

    /**
     * Get the thread topic.
     *
     * @return  string
     */
    public function getThreadtopic()
    {
        return $this->threadtopic;
    }

    /**
     * Set the thread topic.
     *
     * @param  string  $threadtopic  The thread topic.
     *
     * @return  self
     */
    public function setThreadtopic(string $threadtopic)
    {
        $this->threadtopic = $threadtopic;

        return $this;
    }

    /**
     * Get the content type.
     *
     * @return  string
     */
    public function getContenttype()
    {
        return $this->contenttype;
    }

    /**
     * Set the content type.
     *
     * @param  string  $contenttype  The content type.
     *
     * @return  self
     */
    public function setContenttype(string $contenttype)
    {
        $this->contenttype = $contenttype;

        return $this;
    }

    /**
     * Get the MLS epoch.
     *
     * @return  string
     */
    public function getMlsEpoch()
    {
        return $this->mlsEpoch;
    }

    /**
     * Set the MLS epoch.
     *
     * @param  string  $mlsEpoch  The MLS epoch.
     *
     * @return  self
     */
    public function setMlsEpoch(string $mlsEpoch)
    {
        $this->mlsEpoch = $mlsEpoch;

        return $this;
    }

    /**
     * Get the active status.
     *
     * @return  string
     */
    public function getIsactive()
    {
        return $this->isactive;
    }

    /**
     * Set the active status.
     *
     * @param  string  $isactive  The active status.
     *
     * @return  self
     */
    public function setIsactive(string $isactive)
    {
        $this->isactive = $isactive;

        return $this;
    }
}
