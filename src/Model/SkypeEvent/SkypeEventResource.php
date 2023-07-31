<?php

namespace Akbv\PhpSkype\Model\SkypeEvent;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SkypeEventResource
{
    /**
     * The ackrequired for this resource.
     * @var string
     */
    private $ackRequired;

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
    private $clientMessageId;

    /**
     * The version for this resource.
     * @var int
     */
    private $version;

    /**
     * The messagetype for this resource.
     * messagetype
     * @var string
     */
    private $messageType;

    /**
     * The counterpartymessageid for this resource.
     * @var string
     */
    private $counterPartyMessageId;

    /**
     * The imdisplayname for this resource.
     * @var string
     */
    private $imDisplayName;

    /**
     * The receiverdisplayname for this resource.
     * @var string
     */
    private $receiverDisplayName;

    /**
     * The content for this resource.
     * @var string
     */
    private $content;

    /**
     * The composetime for this resource.
     * @var string
     */
    private $composeTime;

    /**
     * The origincontextid for this resource.
     * @var string
     */
    private $originContextId;

    /**
     * The originalarrivaltime for this resource.
     * @var string
     */
    private $originalArrivalTime;

    /**
     * The threadtopic for this resource.
     * @var string
     */
    private $threadTopic;

    /**
     * The contenttype for this resource.
     * @var string
     */
    private $contentType;

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
    private $isActive;

    /**
     * The id for this resource.
     * @var string
     */
    private $id;

    /**
     * The editauthorized for this resource.
     * @var string
     */
    private $editAuthorized;

    /**
     * The skypeeditedid for this resource.
     * @var string
     */
    private $skypeEditedId;

    /**
     * The targetLink for this resource.
     * @var string
     */
    private $targetLink;

    /**
     * The threadProperties for this resource.
     * @var \Akbv\PhpSkype\Model\SkypeEvent\SkypeEventResourceThreadProperties
     */
    private $threadProperties;

    /**
     * The properties for this resource.
     * @var \Akbv\PhpSkype\Model\SkypeEvent\SkypeEventResourceProperties
     */
    private $properties;

    /**
     * The lastMessage for this resource.
     * @var \Akbv\PhpSkype\Model\SkypeMessage\SkypeMessage
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
    private $contentFormat;

    /**
     * The has_mentions for this resource.
     * @var string
     */
    private $hasMentions;

    /**
     * The amsreferences for this resource.
     * @var string[]
     */
    private $asmReferences;

    /**
     * The s2spartnername for this resource.
     * @var string
     */
    private $s2sPartnerName;

    /**
     * The skypeguid for this resource.
     * @var string
     */
    private $skypeGuid;

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
        $data['ackrequired'] = $this->ackRequired;
        $data['type'] = $this->type;
        $data['from'] = $this->from;
        $data['clientmessageid'] = $this->clientMessageId;
        $data['version'] = $this->version;
        $data['messagetype'] = $this->messageType;
        $data['counterpartymessageid'] = $this->counterPartyMessageId;
        $data['imdisplayname'] = $this->imDisplayName;
        $data['receiverdisplayname'] = $this->receiverDisplayName;
        $data['content'] = $this->content;
        $data['composetime'] = $this->composeTime;
        $data['origincontextid'] = $this->originContextId;
        $data['originalarrivaltime'] = $this->originalArrivalTime;
        $data['threadtopic'] = $this->threadTopic;
        $data['contenttype'] = $this->contentType;
        $data['mlsepoch'] = $this->mlsEpoch;
        $data['conversationLink'] = $this->conversationLink;
        $data['isactive'] = $this->isActive;
        $data['id'] = $this->id;
        $data['editauthorized'] = $this->editAuthorized;
        $data['skypeeditedid'] = $this->skypeEditedId;
        $data['targetLink'] = $this->targetLink;
        $data['threadProperties'] = $this->threadProperties->toArray();
        $data['properties'] = $this->properties->toArray();
        $data['lastMessage'] = $this->lastMessage->toArray();
        $data['messages'] = $this->messages;
        $data['lastUpdatedMessageId'] = $this->lastUpdatedMessageId;
        $data['lastUpdatedMessageVersion'] = $this->lastUpdatedMessageVersion;
        $data['botsSettings'] = $this->botsSettings;
        $data['members'] = $this->members;
        $data['rosterVersion'] = $this->rosterVersion;
        $data['eTag'] = $this->eTag;
        $data['contentformat'] = $this->contentFormat;
        $data['has_mentions'] = $this->hasMentions;
        $data['amsreferences'] = $this->asmReferences;
        $data['s2spartnername'] = $this->s2sPartnerName;
        $data['skypeguid'] = $this->skypeGuid;
    
        return $data;
    }

    private function fromArray($raw)
    {
        $this->ackRequired = !empty($raw->ackrequired) ? $raw->ackrequired : null;
        $this->type = !empty($raw->type) ? $raw->type : null;
        $this->from = !empty($raw->from) ? $raw->from : null;
        $this->clientMessageId = !empty($raw->clientmessageid) ? $raw->clientmessageid : null;
        $this->version = !empty($raw->version) ? $raw->version : null;
        $this->messageType = !empty($raw->messagetype) ? $raw->messagetype : null;
        $this->counterPartyMessageId = !empty($raw->counterpartymessageid) ? $raw->counterpartymessageid : null;
        $this->imDisplayName = !empty($raw->imdisplayname) ? $raw->imdisplayname : null;
        $this->receiverDisplayName = !empty($raw->receiverdisplayname) ? $raw->receiverdisplayname : null;
        $this->content = !empty($raw->content) ? $raw->content : null;
        $this->composeTime = !empty($raw->composetime) ? $raw->composetime : null;
        $this->originContextId = !empty($raw->origincontextid) ? $raw->origincontextid : null;
        $this->originalArrivalTime = !empty($raw->originalarrivaltime) ? $raw->originalarrivaltime : null;
        $this->threadTopic = !empty($raw->threadtopic) ? $raw->threadtopic : null;
        $this->contentType = !empty($raw->contenttype) ? $raw->contenttype : null;  
        $this->mlsEpoch = !empty($raw->mlsepoch) ? $raw->mlsepoch : null;
        $this->conversationLink = !empty($raw->conversationLink) ? $raw->conversationLink : null;
        $this->isActive = !empty($raw->isactive) ? $raw->isactive : null;
        $this->id = !empty($raw->id) ? $raw->id : null;
        $this->editAuthorized = !empty($raw->editauthorized) ? $raw->editauthorized : null;
        $this->skypeEditedId = !empty($raw->skypeeditedid) ? $raw->skypeeditedid : null;
        $this->targetLink = !empty($raw->targetLink) ? $raw->targetLink : null;
        $this->threadProperties = new \Akbv\PhpSkype\Model\SkypeEvent\SkypeEventResourceThreadProperties(!empty($raw->threadProperties) ? $raw->threadProperties : (object)[]);
        $this->properties = new \Akbv\PhpSkype\Model\SkypeEvent\SkypeEventResourceProperties(!empty($raw->properties) ? $raw->properties : (object)[]);
        $this->lastMessage = new \Akbv\PhpSkype\Model\SkypeMessage\SkypeMessage(!empty($raw->lastMessage) ? $raw->lastMessage : (object)[]);
        $this->messages = !empty($raw->messages) ? $raw->messages : null;
        $this->lastUpdatedMessageId = !empty($raw->lastUpdatedMessageId) ? $raw->lastUpdatedMessageId : null;
        $this->lastUpdatedMessageVersion = !empty($raw->lastUpdatedMessageVersion) ? $raw->lastUpdatedMessageVersion : null;
        $this->botsSettings = !empty($raw->botsSettings) ? $raw->botsSettings : null;
        $this->members = !empty($raw->members) ? $raw->members : null;
        $this->rosterVersion = !empty($raw->rosterVersion) ? $raw->rosterVersion : null;
        $this->eTag = !empty($raw->eTag) ? $raw->eTag : null;
        $this->contentFormat = !empty($raw->contentformat) ? $raw->contentformat : null;
        $this->hasMentions = !empty($raw->has_mentions) ? $raw->has_mentions : null;
        $this->asmReferences = !empty($raw->amsreferences) ? $raw->amsreferences : null;
        $this->s2sPartnerName = !empty($raw->s2spartnername) ? $raw->s2spartnername : null;
        $this->skypeGuid = !empty($raw->skypeguid) ? $raw->skypeguid : null;

    }

    /**
     * Get the ackrequired for this resource.
     *
     * @return  string
     */ 
    public function getAckRequired()
    {
        return $this->ackRequired;
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
     * Get the from for this resource.
     *
     * @return  string
     */ 
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Get the clientmessageid for this resource.
     *
     * @return  string
     */ 
    public function getClientMessageId()
    {
        return $this->clientMessageId;
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
     * Get messagetype
     *
     * @return  string
     */ 
    public function getMessageType()
    {
        return $this->messageType;
    }

    /**
     * Get the counterpartymessageid for this resource.
     *
     * @return  string
     */ 
    public function getCounterPartyMessageId()
    {
        return $this->counterPartyMessageId;
    }

    /**
     * Get the imdisplayname for this resource.
     *
     * @return  string
     */ 
    public function getImDisplayName()
    {
        return $this->imDisplayName;
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
     * Get the composetime for this resource.
     *
     * @return  string
     */ 
    public function getComposeTime()
    {
        return $this->composeTime;
    }

    /**
     * Get the origincontextid for this resource.
     *
     * @return  string
     */ 
    public function getOriginContextId()
    {
        return $this->originContextId;
    }

    /**
     * Get the originalarrivaltime for this resource.
     *
     * @return  string
     */ 
    public function getOriginalArrivalTime()
    {
        return $this->originalArrivalTime;
    }

    /**
     * Get the threadtopic for this resource.
     *
     * @return  string
     */ 
    public function getThreadTopic()
    {
        return $this->threadTopic;
    }

    /**
     * Get the contenttype for this resource.
     *
     * @return  string
     */ 
    public function getContentType()
    {
        return $this->contentType;
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
     * Get the conversationLink for this resource.
     *
     * @return  string
     */ 
    public function getConversationLink()
    {
        return $this->conversationLink;
    }

    /**
     * Get the isactive for this resource.
     *
     * @return  bool
     */ 
    public function getIsActive()
    {
        return $this->isActive;
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
     * Get the editauthorized for this resource.
     *
     * @return  string
     */ 
    public function getEditAuthorized()
    {
        return $this->editAuthorized;
    }

    /**
     * Get the skypeeditedid for this resource.
     *
     * @return  string
     */ 
    public function getSkypeEditedId()
    {
        return $this->skypeEditedId;
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
     * Get the threadProperties for this resource.
     *
     * @return  \Akbv\PhpSkype\Model\SkypeEvent\SkypeEventResourceThreadProperties
     */ 
    public function getThreadProperties()
    {
        return $this->threadProperties;
    }

    /**
     * Get the properties for this resource.
     *
     * @return  \Akbv\PhpSkype\Model\SkypeEvent\SkypeEventResourceProperties
     */ 
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Get the lastMessage for this resource.
     *
     * @return  \Akbv\PhpSkype\Model\SkypeMessage\SkypeMessage
     */ 
    public function getLastMessage()
    {
        return $this->lastMessage;
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
     * Get the lastUpdatedMessageId for this resource.
     *
     * @return  int
     */ 
    public function getLastUpdatedMessageId()
    {
        return $this->lastUpdatedMessageId;
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
     * Get the members for this resource.
     *
     * @return  string[]
     */ 
    public function getMembers()
    {
        return $this->members;
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
     * Get the eTag for this resource.
     *
     * @return  string
     */ 
    public function getETag()
    {
        return $this->eTag;
    }

    /**
     * Get the contentformat for this resource.
     *
     * @return  string
     */ 
    public function getContentFormat()
    {
        return $this->contentFormat;
    }

    /**
     * Get the has_mentions for this resource.
     *
     * @return  string
     */ 
    public function getHasMentions()
    {
        return $this->hasMentions;
    }

    /**
     * Get the amsreferences for this resource.
     *
     * @return  string[]
     */ 
    public function getAsmReferences()
    {
        return $this->asmReferences;
    }

    /**
     * Get the s2spartnername for this resource.
     *
     * @return  string
     */ 
    public function getS2sPartnerName()
    {
        return $this->s2sPartnerName;
    }

    /**
     * Get the skypeguid for this resource.
     *
     * @return  string
     */ 
    public function getSkypeGuid()
    {
        return $this->skypeGuid;
    }
}
