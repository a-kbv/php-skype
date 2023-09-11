<?php

namespace Akbv\PhpSkype\Model\SkypeDirectoryMessage;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SkypeDirectoryMessage extends \Akbv\PhpSkype\Model\Base
{
    /**
     * Content
    * @var string
    */
    private $content;

    /**
     * ContentType
     * @var string
     */
    private $contentType;

    /**
     * ConversationId
     * @var string
     */
    private $conversationId;

    /**
     * ConversationType
     * @var string
     */
    private $conversationType;

    /**
     * CreationDate
     * @var string
     */
    private $creationDate;

    /**
     * MessageId
     * @var string
     */
    private $messageId;

    /**
     * From
     * @var string
     */
    private $from;

    /**
     * To
     * @var string
     */
    private $to;

    /**
     * ClientMessageId
     * @var string
     */
    private $clientMessageId;

    /**
     * ServerMessageId
     * @var string
     */
    private $serverMessageId;

    /**
     * ThreadId
     * @var string
     */
    private $threadId;

    /**
     * GroupId
     * @var string
     */
    private $groupId;

    /**
     * ParentReferenceId
     * @var string
     */
    private $parentReferenceId;

    /**
     * SenderDisplayName
     * @var string
     */
    private $senderDisplayName;

    /**
     * MessageType
     * @var string
     */
    private $messageType;

    /**
     * MessageSubtype
     * @var string
     */
    private $messageSubtype;

    /**
     * MetadataList
     * @var string[]
     */
    private $metadataList;


    public function __construct($raw)
    {
        $this->fromArray($raw);
    }

    public function toArray()
    {
        $data['content'] = $this->content;
        $data['contentType'] = $this->contentType;
        $data['conversationId'] = $this->conversationId;
        $data['conversationType'] = $this->conversationType;
        $data['creationDate'] = $this->creationDate;
        $data['messageId'] = $this->messageId;
        $data['from'] = $this->from;
        $data['to'] = $this->to;
        $data['clientMessageId'] = $this->clientMessageId;
        $data['serverMessageId'] = $this->serverMessageId;
        $data['threadId'] = $this->threadId;
        $data['groupId'] = $this->groupId;
        $data['parentReferenceId'] = $this->parentReferenceId;
        $data['senderDisplayName'] = $this->senderDisplayName;
        $data['messageType'] = $this->messageType;
        $data['messageSubtype'] = $this->messageSubtype;
        $data['metadataList'] = $this->metadataList;

        return $data;
    }

    private function fromArray($raw)
    {
        if (!is_object($raw)) {
            $raw = (object) $raw;
        }

        $this->content = !empty($raw->Content) ? $raw->Content : null;
        $this->contentType = !empty($raw->ContentType) ? $raw->ContentType : null;
        $this->conversationId = !empty($raw->ConversationId) ? $raw->ConversationId : null;
        $this->conversationType = !empty($raw->ConversationType) ? $raw->ConversationType : null;
        $this->creationDate = !empty($raw->CreationDate) ? $raw->CreationDate : null;
        $this->messageId = !empty($raw->Id) ? $raw->Id : null;
        $this->from = !empty($raw->From) ? $raw->From : null;
        $this->to = !empty($raw->To) ? $raw->To : null;
        $this->clientMessageId = !empty($raw->ClientMessageId) ? $raw->ClientMessageId : null;
        $this->serverMessageId = !empty($raw->ServerMessageId) ? $raw->ServerMessageId : null;
        $this->threadId = !empty($raw->ThreadId) ? $raw->ThreadId : null;
        $this->groupId = !empty($raw->GroupId) ? $raw->GroupId : null;
        $this->parentReferenceId = !empty($raw->ParentReferenceId) ? $raw->ParentReferenceId : null;
        $this->senderDisplayName = !empty($raw->SenderDisplayName) ? $raw->SenderDisplayName : null;
        $this->messageType = !empty($raw->MessageType) ? $raw->MessageType : null;
        $this->messageSubtype = !empty($raw->MessageSubtype) ? $raw->MessageSubtype : null;
        $this->metadataList = !empty($raw->MetadataList) ? $raw->MetadataList : null;
    }




    /**
     * Get content
     *
     * @return  string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set content
     *
     * @param  string  $content  Content
     *
     * @return  self
     */
    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get contentType
     *
     * @return  string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * Set contentType
     *
     * @param  string  $contentType  ContentType
     *
     * @return  self
     */
    public function setContentType(string $contentType)
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * Get conversationId
     *
     * @return  string
     */
    public function getConversationId()
    {
        return $this->conversationId;
    }

    /**
     * Set conversationId
     *
     * @param  string  $conversationId  ConversationId
     *
     * @return  self
     */
    public function setConversationId(string $conversationId)
    {
        $this->conversationId = $conversationId;

        return $this;
    }

    /**
     * Get conversationType
     *
     * @return  string
     */
    public function getConversationType()
    {
        return $this->conversationType;
    }

    /**
     * Set conversationType
     *
     * @param  string  $conversationType  ConversationType
     *
     * @return  self
     */
    public function setConversationType(string $conversationType)
    {
        $this->conversationType = $conversationType;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return  string
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set creationDate
     *
     * @param  string  $creationDate  CreationDate
     *
     * @return  self
     */
    public function setCreationDate(string $creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get messageId
     *
     * @return  string
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * Set messageId
     *
     * @param  string  $messageId  MessageId
     *
     * @return  self
     */
    public function setMessageId(string $messageId)
    {
        $this->messageId = $messageId;

        return $this;
    }

    /**
     * Get from
     *
     * @return  string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set from
     *
     * @param  string  $from  From
     *
     * @return  self
     */
    public function setFrom(string $from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get to
     *
     * @return  string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set to
     *
     * @param  string  $to  To
     *
     * @return  self
     */
    public function setTo(string $to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get clientMessageId
     *
     * @return  string
     */
    public function getClientMessageId()
    {
        return $this->clientMessageId;
    }

    /**
     * Set clientMessageId
     *
     * @param  string  $clientMessageId  ClientMessageId
     *
     * @return  self
     */
    public function setClientMessageId(string $clientMessageId)
    {
        $this->clientMessageId = $clientMessageId;

        return $this;
    }

    /**
     * Get serverMessageId
     *
     * @return  string
     */
    public function getServerMessageId()
    {
        return $this->serverMessageId;
    }

    /**
     * Set serverMessageId
     *
     * @param  string  $serverMessageId  ServerMessageId
     *
     * @return  self
     */
    public function setServerMessageId(string $serverMessageId)
    {
        $this->serverMessageId = $serverMessageId;

        return $this;
    }

    /**
     * Get threadId
     *
     * @return  string
     */
    public function getThreadId()
    {
        return $this->threadId;
    }

    /**
     * Set threadId
     *
     * @param  string  $threadId  ThreadId
     *
     * @return  self
     */
    public function setThreadId(string $threadId)
    {
        $this->threadId = $threadId;

        return $this;
    }

    /**
     * Get groupId
     *
     * @return  string
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * Set groupId
     *
     * @param  string  $groupId  GroupId
     *
     * @return  self
     */
    public function setGroupId(string $groupId)
    {
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * Get parentReferenceId
     *
     * @return  string
     */
    public function getParentReferenceId()
    {
        return $this->parentReferenceId;
    }

    /**
     * Set parentReferenceId
     *
     * @param  string  $parentReferenceId  ParentReferenceId
     *
     * @return  self
     */
    public function setParentReferenceId(string $parentReferenceId)
    {
        $this->parentReferenceId = $parentReferenceId;

        return $this;
    }

    /**
     * Get senderDisplayName
     *
     * @return  string
     */
    public function getSenderDisplayName()
    {
        return $this->senderDisplayName;
    }

    /**
     * Set senderDisplayName
     *
     * @param  string  $senderDisplayName  SenderDisplayName
     *
     * @return  self
     */
    public function setSenderDisplayName(string $senderDisplayName)
    {
        $this->senderDisplayName = $senderDisplayName;

        return $this;
    }

    /**
     * Get messageSubtype
     *
     * @return  string
     */
    public function getMessageSubtype()
    {
        return $this->messageSubtype;
    }

    /**
     * Set messageSubtype
     *
     * @param  string  $messageSubtype  MessageSubtype
     *
     * @return  self
     */
    public function setMessageSubtype(string $messageSubtype)
    {
        $this->messageSubtype = $messageSubtype;

        return $this;
    }

    /**
     * Get metadataList
     *
     * @return  string[]
     */
    public function getMetadataList()
    {
        return $this->metadataList;
    }

    /**
     * Set metadataList
     *
     * @param  string[]  $metadataList  MetadataList
     *
     * @return  self
     */
    public function setMetadataList(array $metadataList)
    {
        $this->metadataList = $metadataList;

        return $this;
    }
}
