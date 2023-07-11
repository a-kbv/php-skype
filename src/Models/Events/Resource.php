<?php

namespace Akbv\PhpSkype\Models\Events;

use Akbv\PhpSkype\Utils\Utils;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class Resource extends \Akbv\PhpSkype\Models\Base
{
    /**
     * The ackrequired for this resource.
     * @var string
     */
    private $ackrequired;

    /**
     * The type for this resource.
     * @var string
     */
    private $type;

    /**
     * The from for this resource.
     * @var string
     */
    private $from;

    /**
     * The clientmessageid for this resource.
     * @var string
     */
    private $clientmessageid;

    /**
     * The version for this resource.
     * @var int
     */
    private $version;

    /**
     * The messagetype for this resource.
     * @var string
     */
    private $messagetype;

    /**
     * The counterpartymessageid for this resource.
     * @var string
     */
    private $counterpartymessageid;

    /**
     * The imdisplayname for this resource.
     * @var string
     */
    private $imdisplayname;

    /**
     * The reciever for this resource.
     */
    private $receiverdisplayname;

    /**
     * The content for this resource.
     * @var string
     */
    private $content;

    /**
     * The composetime for this resource.
     * @var string
     */
    private $composetime;

    /**
     * The origincontextid for this resource.
     * @var string
     */
    private $origincontextid;

    /**
     * The originalarrivaltime for this resource.
     * @var string
     */
    private $originalarrivaltime;

    /**
     * The threadtopic for this resource.
     * @var string
     */
    private $threadtopic;

    /**
     * The contenttype for this resource.
     * @var string
     */
    private $contenttype;

    /**
     * The mlsEpoch for this resource.
     * @var string
     */
    private $mlsEpoch;

    /**
     * The conversationLink for this resource.
     * @var string
     */
    private $conversationLink;

    /**
     * The isactive for this resource.
     * @var bool
     */
    private $isactive;

    /**
     * The id for this resource.
     * @var string
     */
    private $id;

    /**
     * The editauthorized for this resource.
     * @var string
     */
    private $editauthorized;

    /**
     * The skypeeditedid for this resource.
     * @var string
     */
    private $skypeeditedid;

    /**
     * The targetLink for this resource.
     * @var string
     */
    private $targetLink;

    /**
     * The threadProperties for this resource.
     * @var \Akbv\PhpSkype\Models\Events\ThreadProperties
     */
    private $threadProperties;

    /**
     * The properties for this resource.
     * @var \Akbv\PhpSkype\Models\Events\Properties
     */
    private $properties;

    /**
     * The lastMessage for this resource.
     * @var \Akbv\PhpSkype\Models\Events\LastMessage
     */
    private $lastMessage;

    /**
     * The messages for this resource.
     * @var string
     */
    private $messages;

    /**
     * The lastUpdatedMessageId for this resource.
     * @var int
     */
    private $lastUpdatedMessageId;

    /**
     * The lastUpdatedMessageVersion for this resource.
     * @var int
     */
    private $lastUpdatedMessageVersion;

    /**
     * The botsSettings for this resource.
     * @var string[]
     */
    private $botsSettings;

    /**
     * The members for this resource.
     * @var string[]
     */
    private $members;

    /**
     * The rosterVersion for this resource.
     * @var int
     */
    private $rosterVersion;

    /**
     * The eTag for this resource.
     * @var string
     */
    private $eTag;

    /**
     * The contentformat for this resource.
     * @var string
     */
    private $contentformat;

    /**
     * The has_mentions for this resource.
     * @var string
     */
    private $has_mentions;

    /**
     * The amsreferences for this resource.
     * @var string[]
     */
    private $amsreferences;

    /**
     * The s2spartnername for this resource.
     * @var string
     */
    private $s2spartnername;

    /**
     * The skypeguid for this resource.
     * @var string
     */
    private $skypeguid;

    /**
     * Constructor.
     * @param mixed[] $data
     */
    public function __construct(array $data)
    {
        $this->mapPropertiesFromArray($data);
        $this->threadProperties = new \Akbv\PhpSkype\Models\Events\ThreadProperties((isset($data['threadProperties']) ? $data['threadProperties'] : []));
        $this->properties = new \Akbv\PhpSkype\Models\Events\Properties((isset($data['properties']) ? $data['properties'] : []));
        $this->lastMessage = new \Akbv\PhpSkype\Models\Events\LastMessage((isset($data['lastMessage']) ? $data['lastMessage'] : []));
    }

    /**
     * Get the ackrequired for this resource.
     *
     * @return  string
     */
    public function getAckrequired()
    {
        return $this->ackrequired;
    }

    /**
     * Set the ackrequired for this resource.
     *
     * @param  string  $ackrequired  The ackrequired for this resource.
     *
     * @return  self
     */
    public function setAckrequired(string $ackrequired)
    {
        $this->ackrequired = $ackrequired;

        return $this;
    }

    /**
     * Get the type for this resource.
     *
     * @return  string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the type for this resource.
     *
     * @param  string  $type  The type for this resource.
     *
     * @return  self
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the from for this resource.
     *
     * @return  string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set the from for this resource.
     *
     * @param  string  $from  The from for this resource.
     *
     * @return  self
     */
    public function setFrom(string $from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get the clientmessageid for this resource.
     *
     * @return  string
     */
    public function getClientmessageid()
    {
        return $this->clientmessageid;
    }

    /**
     * Set the clientmessageid for this resource.
     *
     * @param  string  $clientmessageid  The clientmessageid for this resource.
     *
     * @return  self
     */
    public function setClientmessageid(string $clientmessageid)
    {
        $this->clientmessageid = $clientmessageid;

        return $this;
    }

    /**
     * Get the version for this resource.
     *
     * @return  int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set the version for this resource.
     *
     * @param  int  $version  The version for this resource.
     *
     * @return  self
     */
    public function setVersion(int $version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get the messagetype for this resource.
     *
     * @return  string
     */
    public function getMessagetype()
    {
        return $this->messagetype;
    }

    /**
     * Set the messagetype for this resource.
     *
     * @param  string  $messagetype  The messagetype for this resource.
     *
     * @return  self
     */
    public function setMessagetype(string $messagetype)
    {
        $this->messagetype = $messagetype;

        return $this;
    }

    /**
     * Get the counterpartymessageid for this resource.
     *
     * @return  string
     */
    public function getCounterpartymessageid()
    {
        return $this->counterpartymessageid;
    }

    /**
     * Set the counterpartymessageid for this resource.
     *
     * @param  string  $counterpartymessageid  The counterpartymessageid for this resource.
     *
     * @return  self
     */
    public function setCounterpartymessageid(string $counterpartymessageid)
    {
        $this->counterpartymessageid = $counterpartymessageid;

        return $this;
    }

    /**
     * Get the imdisplayname for this resource.
     *
     * @return  string
     */
    public function getImdisplayname()
    {
        return $this->imdisplayname;
    }

    /**
     * Set the imdisplayname for this resource.
     *
     * @param  string  $imdisplayname  The imdisplayname for this resource.
     *
     * @return  self
     */
    public function setImdisplayname(string $imdisplayname)
    {
        $this->imdisplayname = $imdisplayname;

        return $this;
    }

    /**
     * Get the content for this resource.
     *
     * @return  string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the content for this resource.
     *
     * @param  string  $content  The content for this resource.
     *
     * @return  self
     */
    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the composetime for this resource.
     *
     * @return  string
     */
    public function getComposetime()
    {
        return $this->composetime;
    }

    /**
     * Set the composetime for this resource.
     *
     * @param  string  $composetime  The composetime for this resource.
     *
     * @return  self
     */
    public function setComposetime(string $composetime)
    {
        $this->composetime = $composetime;

        return $this;
    }

    /**
     * Get the origincontextid for this resource.
     *
     * @return  string
     */
    public function getOrigincontextid()
    {
        return $this->origincontextid;
    }

    /**
     * Set the origincontextid for this resource.
     *
     * @param  string  $origincontextid  The origincontextid for this resource.
     *
     * @return  self
     */
    public function setOrigincontextid(string $origincontextid)
    {
        $this->origincontextid = $origincontextid;

        return $this;
    }

    /**
     * Get the originalarrivaltime for this resource.
     *
     * @return  string
     */
    public function getOriginalarrivaltime()
    {
        return $this->originalarrivaltime;
    }

    /**
     * Set the originalarrivaltime for this resource.
     *
     * @param  string  $originalarrivaltime  The originalarrivaltime for this resource.
     *
     * @return  self
     */
    public function setOriginalarrivaltime(string $originalarrivaltime)
    {
        $this->originalarrivaltime = $originalarrivaltime;

        return $this;
    }

    /**
     * Get the threadtopic for this resource.
     *
     * @return  string
     */
    public function getThreadtopic()
    {
        return $this->threadtopic;
    }

    /**
     * Set the threadtopic for this resource.
     *
     * @param  string  $threadtopic  The threadtopic for this resource.
     *
     * @return  self
     */
    public function setThreadtopic(string $threadtopic)
    {
        $this->threadtopic = $threadtopic;

        return $this;
    }

    /**
     * Get the contenttype for this resource.
     *
     * @return  string
     */
    public function getContenttype()
    {
        return $this->contenttype;
    }

    /**
     * Set the contenttype for this resource.
     *
     * @param  string  $contenttype  The contenttype for this resource.
     *
     * @return  self
     */
    public function setContenttype(string $contenttype)
    {
        $this->contenttype = $contenttype;

        return $this;
    }

    /**
     * Get the mlsEpoch for this resource.
     *
     * @return  string
     */
    public function getMlsEpoch()
    {
        return $this->mlsEpoch;
    }

    /**
     * Set the mlsEpoch for this resource.
     *
     * @param  string  $mlsEpoch  The mlsEpoch for this resource.
     *
     * @return  self
     */
    public function setMlsEpoch(string $mlsEpoch)
    {
        $this->mlsEpoch = $mlsEpoch;

        return $this;
    }

    /**
     * Get the conversationLink for this resource.
     *
     * @return  string
     */
    public function getConversationLink()
    {
        return $this->conversationLink;
    }

    /**
     * Set the conversationLink for this resource.
     *
     * @param  string  $conversationLink  The conversationLink for this resource.
     *
     * @return  self
     */
    public function setConversationLink(string $conversationLink)
    {
        $this->conversationLink = $conversationLink;

        return $this;
    }

    /**
     * Get the isactive for this resource.
     *
     * @return  bool
     */
    public function getIsactive()
    {
        return $this->isactive;
    }

    /**
     * Set the isactive for this resource.
     *
     * @param  bool  $isactive  The isactive for this resource.
     *
     * @return  self
     */
    public function setIsactive(bool $isactive)
    {
        $this->isactive = $isactive;

        return $this;
    }

    /**
     * Get the id for this resource.
     *
     * @return  string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the id for this resource.
     *
     * @param  string  $id  The id for this resource.
     *
     * @return  self
     */
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the editauthorized for this resource.
     *
     * @return  string
     */
    public function getEditauthorized()
    {
        return $this->editauthorized;
    }

    /**
     * Set the editauthorized for this resource.
     *
     * @param  string  $editauthorized  The editauthorized for this resource.
     *
     * @return  self
     */
    public function setEditauthorized(string $editauthorized)
    {
        $this->editauthorized = $editauthorized;

        return $this;
    }

    /**
     * Get the skypeeditedid for this resource.
     *
     * @return  string
     */
    public function getSkypeeditedid()
    {
        return $this->skypeeditedid;
    }

    /**
     * Set the skypeeditedid for this resource.
     *
     * @param  string  $skypeeditedid  The skypeeditedid for this resource.
     *
     * @return  self
     */
    public function setSkypeeditedid(string $skypeeditedid)
    {
        $this->skypeeditedid = $skypeeditedid;

        return $this;
    }

    /**
     * Get the targetLink for this resource.
     *
     * @return  string
     */
    public function getTargetLink()
    {
        return $this->targetLink;
    }

    /**
     * Set the targetLink for this resource.
     *
     * @param  string  $targetLink  The targetLink for this resource.
     *
     * @return  self
     */
    public function setTargetLink(string $targetLink)
    {
        $this->targetLink = $targetLink;

        return $this;
    }

    /**
     * Get the threadProperties for this resource.
     *
     * @return  \Akbv\PhpSkype\Models\Events\ThreadProperties
     */
    public function getThreadProperties()
    {
        return $this->threadProperties;
    }

    /**
     * Set the threadProperties for this resource.
     *
     * @param  \Akbv\PhpSkype\Models\Events\ThreadProperties  $threadProperties  The threadProperties for this resource.
     *
     * @return  self
     */
    public function setThreadProperties(\Akbv\PhpSkype\Models\Events\ThreadProperties $threadProperties)
    {
        $this->threadProperties = $threadProperties;

        return $this;
    }

    /**
     * Get the properties for this resource.
     *
     * @return  \Akbv\PhpSkype\Models\Events\Properties
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Set the properties for this resource.
     *
     * @param  \Akbv\PhpSkype\Models\Events\Properties  $properties  The properties for this resource.
     *
     * @return  self
     */
    public function setProperties(\Akbv\PhpSkype\Models\Events\Properties $properties)
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * Get the lastMessage for this resource.
     *
     * @return  \Akbv\PhpSkype\Models\Events\LastMessage
     */
    public function getLastMessage()
    {
        return $this->lastMessage;
    }

    /**
     * Set the lastMessage for this resource.
     *
     * @param  \Akbv\PhpSkype\Models\Events\LastMessage  $lastMessage  The lastMessage for this resource.
     *
     * @return  self
     */
    public function setLastMessage(\Akbv\PhpSkype\Models\Events\LastMessage $lastMessage)
    {
        $this->lastMessage = $lastMessage;

        return $this;
    }

    /**
     * Get the messages for this resource.
     *
     * @return  string
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Set the messages for this resource.
     *
     * @param  string  $messages  The messages for this resource.
     *
     * @return  self
     */
    public function setMessages(string $messages)
    {
        $this->messages = $messages;

        return $this;
    }

    /**
     * Get the lastUpdatedMessageId for this resource.
     *
     * @return  int
     */
    public function getLastUpdatedMessageId()
    {
        return $this->lastUpdatedMessageId;
    }

    /**
     * Set the lastUpdatedMessageId for this resource.
     *
     * @param  int  $lastUpdatedMessageId  The lastUpdatedMessageId for this resource.
     *
     * @return  self
     */
    public function setLastUpdatedMessageId(int $lastUpdatedMessageId)
    {
        $this->lastUpdatedMessageId = $lastUpdatedMessageId;

        return $this;
    }

    /**
     * Get the lastUpdatedMessageVersion for this resource.
     *
     * @return  int
     */
    public function getLastUpdatedMessageVersion()
    {
        return $this->lastUpdatedMessageVersion;
    }

    /**
     * Set the lastUpdatedMessageVersion for this resource.
     *
     * @param  int  $lastUpdatedMessageVersion  The lastUpdatedMessageVersion for this resource.
     *
     * @return  self
     */
    public function setLastUpdatedMessageVersion(int $lastUpdatedMessageVersion)
    {
        $this->lastUpdatedMessageVersion = $lastUpdatedMessageVersion;

        return $this;
    }

    /**
     * Get the botsSettings for this resource.
     *
     * @return  string[]
     */
    public function getBotsSettings()
    {
        return $this->botsSettings;
    }

    /**
     * Set the botsSettings for this resource.
     *
     * @param  string[]  $botsSettings  The botsSettings for this resource.
     *
     * @return  self
     */
    public function setBotsSettings(array $botsSettings)
    {
        $this->botsSettings = $botsSettings;

        return $this;
    }

    /**
     * Get the members for this resource.
     *
     * @return  string[]
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Set the members for this resource.
     *
     * @param  string[]  $members  The members for this resource.
     *
     * @return  self
     */
    public function setMembers(array $members)
    {
        $this->members = $members;

        return $this;
    }

    /**
     * Get the rosterVersion for this resource.
     *
     * @return  int
     */
    public function getRosterVersion()
    {
        return $this->rosterVersion;
    }

    /**
     * Set the rosterVersion for this resource.
     *
     * @param  int  $rosterVersion  The rosterVersion for this resource.
     *
     * @return  self
     */
    public function setRosterVersion(int $rosterVersion)
    {
        $this->rosterVersion = $rosterVersion;

        return $this;
    }

    /**
     * Get the eTag for this resource.
     *
     * @return  string
     */
    public function getETag()
    {
        return $this->eTag;
    }

    /**
     * Set the eTag for this resource.
     *
     * @param  string  $eTag  The eTag for this resource.
     *
     * @return  self
     */
    public function setETag(string $eTag)
    {
        $this->eTag = $eTag;

        return $this;
    }

    /**
     * Get the contentformat for this resource.
     *
     * @return  string
     */
    public function getContentformat()
    {
        return $this->contentformat;
    }

    /**
     * Set the contentformat for this resource.
     *
     * @param  string  $contentformat  The contentformat for this resource.
     *
     * @return  self
     */
    public function setContentformat(string $contentformat)
    {
        $this->contentformat = $contentformat;

        return $this;
    }

    /**
     * Get the has_mentions for this resource.
     *
     * @return  string
     */
    public function getHas_mentions()
    {
        return $this->has_mentions;
    }

    /**
     * Set the has_mentions for this resource.
     *
     * @param  string  $has_mentions  The has_mentions for this resource.
     *
     * @return  self
     */
    public function setHas_mentions(string $has_mentions)
    {
        $this->has_mentions = $has_mentions;

        return $this;
    }

    /**
     * Get the amsreferences for this resource.
     *
     * @return  string[]
     */
    public function getAmsreferences()
    {
        return $this->amsreferences;
    }

    /**
     * Set the amsreferences for this resource.
     *
     * @param  string[]  $amsreferences  The amsreferences for this resource.
     *
     * @return  self
     */
    public function setAmsreferences(array $amsreferences)
    {
        $this->amsreferences = $amsreferences;

        return $this;
    }

    /**
     * Get the s2spartnername for this resource.
     *
     * @return  string
     */
    public function getS2spartnername()
    {
        return $this->s2spartnername;
    }

    /**
     * Set the s2spartnername for this resource.
     *
     * @param  string  $s2spartnername  The s2spartnername for this resource.
     *
     * @return  self
     */
    public function setS2spartnername(string $s2spartnername)
    {
        $this->s2spartnername = $s2spartnername;

        return $this;
    }

    /**
     * Get the skypeguid for this resource.
     *
     * @return  string
     */
    public function getSkypeguid()
    {
        return $this->skypeguid;
    }

    /**
     * Set the skypeguid for this resource.
     *
     * @param  string  $skypeguid  The skypeguid for this resource.
     *
     * @return  self
     */
    public function setSkypeguid(string $skypeguid)
    {
        $this->skypeguid = $skypeguid;

        return $this;
    }

    /**
     * Get the reciever for this resource.
     */
    public function getReceiverdisplayname()
    {
        return $this->receiverdisplayname;
    }

    /**
     * Set the reciever for this resource.
     *
     * @return  self
     */
    public function setReceiverdisplayname($receiverdisplayname)
    {
        $this->receiverdisplayname = $receiverdisplayname;

        return $this;
    }
}
