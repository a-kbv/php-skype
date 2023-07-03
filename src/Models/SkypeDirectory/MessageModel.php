<?php

namespace Akbv\PhpSkype\Models\SkypeDirectory;

/**
 * A raw conversation model.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class MessageModel extends \Akbv\PhpSkype\Models\Base
{

    /**
     * The content of the message.
     * @var string
     */
    private $Content;

    /**
     * The content type of the message.
     * @var string
     */
    private $ContentType;

    /**
     * The conversation id.
     * @var string
     */
    private $ConversationId;

    /**
     * The conversation type.
     * @var string
     */
    private $ConversationType;

    /**
     * The creation date of the message.
     * @var string
     */
    private $CreationDate;

    /**
     * The message id.
     * @var string
     */
    private $MessageId;

    /**
     * The sender of the message.
     * @var string
     */
    private $From;

    /**
     * The receiver of the message.
     * @var string
     */
    private $To;

    /**
     * The client message id.
     * @var string
     */
    private $ClientMessageId;

    /**
     * The server message id.
     * @var string
     */
    private $ServerMessageId;

    /**
     * The thread id.
     * @var string
     */
    private $ThreadId;

    /**
     * The group id.
     * @var string
     */
    private $GroupId;

    /**
     * The parent reference id.
     * @var string
     */
    private $ParentReferenceId;

    /**
     * The sender display name.
     * @var string
     */
    private $SenderDisplayName;

    /**
     * The message type.
     * @var string
     */
    private $MessageType;

    /**
     * The message subtype.
     * @var string
     */
    private $MessageSubtype;

    /**
     * The metadata list.
     * @var string[]
     */
    private $MetadataList;

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
     * Get the content of the message.
     *
     * @return  string
     */
    public function getContent()
    {
        return $this->Content;
    }

    /**
     * Set the content of the message.
     *
     * @param  string  $Content  The content of the message.
     *
     * @return  self
     */
    public function setContent(string $Content)
    {
        $this->Content = $Content;

        return $this;
    }

    /**
     * Get the content type of the message.
     *
     * @return  string
     */
    public function getContentType()
    {
        return $this->ContentType;
    }

    /**
     * Set the content type of the message.
     *
     * @param  string  $ContentType  The content type of the message.
     *
     * @return  self
     */
    public function setContentType(string $ContentType)
    {
        $this->ContentType = $ContentType;

        return $this;
    }

    /**
     * Get the conversation id.
     *
     * @return  string
     */
    public function getConversationId()
    {
        return $this->ConversationId;
    }

    /**
     * Set the conversation id.
     *
     * @param  string  $ConversationId  The conversation id.
     *
     * @return  self
     */
    public function setConversationId(string $ConversationId)
    {
        $this->ConversationId = $ConversationId;

        return $this;
    }

    /**
     * Get the conversation type.
     *
     * @return  string
     */
    public function getConversationType()
    {
        return $this->ConversationType;
    }

    /**
     * Set the conversation type.
     *
     * @param  string  $ConversationType  The conversation type.
     *
     * @return  self
     */
    public function setConversationType(string $ConversationType)
    {
        $this->ConversationType = $ConversationType;

        return $this;
    }

    /**
     * Get the creation date of the message.
     *
     * @return  string
     */
    public function getCreationDate()
    {
        return $this->CreationDate;
    }

    /**
     * Set the creation date of the message.
     *
     * @param  string  $CreationDate  The creation date of the message.
     *
     * @return  self
     */
    public function setCreationDate(string $CreationDate)
    {
        $this->CreationDate = $CreationDate;

        return $this;
    }

    /**
     * Get the message id.
     *
     * @return  string
     */
    public function getMessageId()
    {
        return $this->MessageId;
    }

    /**
     * Set the message id.
     *
     * @param  string  $MessageId  The message id.
     *
     * @return  self
     */
    public function setMessageId(string $MessageId)
    {
        $this->MessageId = $MessageId;

        return $this;
    }

    /**
     * Get the sender of the message.
     *
     * @return  string
     */
    public function getFrom()
    {
        return $this->From;
    }

    /**
     * Set the sender of the message.
     *
     * @param  string  $From  The sender of the message.
     *
     * @return  self
     */
    public function setFrom(string $From)
    {
        $this->From = $From;

        return $this;
    }

    /**
     * Get the receiver of the message.
     *
     * @return  string
     */
    public function getTo()
    {
        return $this->To;
    }

    /**
     * Set the receiver of the message.
     *
     * @param  string  $To  The receiver of the message.
     *
     * @return  self
     */
    public function setTo(string $To)
    {
        $this->To = $To;

        return $this;
    }

    /**
     * Get the client message id.
     *
     * @return  string
     */
    public function getClientMessageId()
    {
        return $this->ClientMessageId;
    }

    /**
     * Set the client message id.
     *
     * @param  string  $ClientMessageId  The client message id.
     *
     * @return  self
     */
    public function setClientMessageId(string $ClientMessageId)
    {
        $this->ClientMessageId = $ClientMessageId;

        return $this;
    }

    /**
     * Get the server message id.
     *
     * @return  string
     */
    public function getServerMessageId()
    {
        return $this->ServerMessageId;
    }

    /**
     * Set the server message id.
     *
     * @param  string  $ServerMessageId  The server message id.
     *
     * @return  self
     */
    public function setServerMessageId(string $ServerMessageId)
    {
        $this->ServerMessageId = $ServerMessageId;

        return $this;
    }

    /**
     * Get the thread id.
     *
     * @return  string
     */
    public function getThreadId()
    {
        return $this->ThreadId;
    }

    /**
     * Set the thread id.
     *
     * @param  string  $ThreadId  The thread id.
     *
     * @return  self
     */
    public function setThreadId(string $ThreadId)
    {
        $this->ThreadId = $ThreadId;

        return $this;
    }

    /**
     * Get the group id.
     *
     * @return  string
     */
    public function getGroupId()
    {
        return $this->GroupId;
    }

    /**
     * Set the group id.
     *
     * @param  string  $GroupId  The group id.
     *
     * @return  self
     */
    public function setGroupId(string $GroupId)
    {
        $this->GroupId = $GroupId;

        return $this;
    }

    /**
     * Get the parent reference id.
     *
     * @return  string
     */
    public function getParentReferenceId()
    {
        return $this->ParentReferenceId;
    }

    /**
     * Set the parent reference id.
     *
     * @param  string  $ParentReferenceId  The parent reference id.
     *
     * @return  self
     */
    public function setParentReferenceId(string $ParentReferenceId)
    {
        $this->ParentReferenceId = $ParentReferenceId;

        return $this;
    }

    /**
     * Get the sender display name.
     *
     * @return  string
     */
    public function getSenderDisplayName()
    {
        return $this->SenderDisplayName;
    }

    /**
     * Set the sender display name.
     *
     * @param  string  $SenderDisplayName  The sender display name.
     *
     * @return  self
     */
    public function setSenderDisplayName(string $SenderDisplayName)
    {
        $this->SenderDisplayName = $SenderDisplayName;

        return $this;
    }

    /**
     * Get the message type.
     *
     * @return  string
     */
    public function getMessageType()
    {
        return $this->MessageType;
    }

    /**
     * Set the message type.
     *
     * @param  string  $MessageType  The message type.
     *
     * @return  self
     */
    public function setMessageType(string $MessageType)
    {
        $this->MessageType = $MessageType;

        return $this;
    }

    /**
     * Get the message subtype.
     *
     * @return  string
     */
    public function getMessageSubtype()
    {
        return $this->MessageSubtype;
    }

    /**
     * Set the message subtype.
     *
     * @param  string  $MessageSubtype  The message subtype.
     *
     * @return  self
     */
    public function setMessageSubtype(string $MessageSubtype)
    {
        $this->MessageSubtype = $MessageSubtype;

        return $this;
    }

    /**
     * Get the metadata list.
     *
     * @return  string[]
     */
    public function getMetadataList()
    {
        return $this->MetadataList;
    }

    /**
     * Set the metadata list.
     *
     * @param  string[]  $MetadataList  The metadata list.
     *
     * @return  self
     */
    public function setMetadataList(array $MetadataList)
    {
        $this->MetadataList = $MetadataList;

        return $this;
    }
}
