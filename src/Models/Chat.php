<?php

namespace Akbv\PhpSkype\Models;

/**
 * Class for mapping the chat.
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class Chat extends Base
{
    /**
     * The unique identifier for this conversation.
     * @var string
     */
    private $id;

    /**
     * targetLink
     * @var string
     */
    private $targetLink;

    /**
     * The type of this conversation.
     * @var string
     */
    private $type;

    /**
     * The version of this conversation.
     * @var int
     */
    private $version;

    /**
     * The properties of this conversation.
     * @var ChatProperties
     */
    private $properties;

    /**
     * The last message in this conversation.
     * @var Message
     */
    private $lastMessage;

    /**
     * The messages in this conversation.
     * @var string
     */
    private $messages;

    /**
     * The last updated message id in this conversation.
     * @var int
     */
    private $lastUpdatedMessageId;

    /**
     * The last updated message version in this conversation.
     * @var int
     */
    private $lastUpdatedMessageVersion;

    /**
     * The list of members in this conversation.
     * @var string[]
     */
    private $members;


    /**
     * Description of the conversation, shown to all participants.
     * @var string
     */
    private $topic;

    /**
     * User who originally created the conversation.
     * @var string
     */
    private $creatorId;

    /**
     * Constructor.
     * @param mixed[] $data The data from which to create the object.
     */
    public function __construct(array $data)
    {
        $this->mapPropertiesFromArray($data);
        $message = new Message(isset($data["lastMessage"]) ? $data["lastMessage"] : []);
        $this->lastMessage = $message;
        $properties = new ChatProperties(isset($data["properties"]) ? $data["properties"] : []);
        $this->properties = $properties;
        $this->jsonSerialize();
    }

    /**
     * Get the unique identifier for this conversation.
     *
     * @return  string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the unique identifier for this conversation.
     *
     * @param  string  $id  The unique identifier for this conversation.
     *
     * @return  self
     */
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get targetLink
     *
     * @return  string
     */
    public function getTargetLink()
    {
        return $this->targetLink;
    }

    /**
     * Set targetLink
     *
     * @param  string  $targetLink  targetLink
     *
     * @return  self
     */
    public function setTargetLink(string $targetLink)
    {
        $this->targetLink = $targetLink;

        return $this;
    }

    /**
     * Get the type of this conversation.
     *
     * @return  string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the type of this conversation.
     *
     * @param  string  $type  The type of this conversation.
     *
     * @return  self
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the version of this conversation.
     *
     * @return  int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set the version of this conversation.
     *
     * @param  int  $version  The version of this conversation.
     *
     * @return  self
     */
    public function setVersion(int $version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get the properties of this conversation.
     *
     * @return  ChatProperties
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Set the properties of this conversation.
     *
     * @param  ChatProperties  $properties  The properties of this conversation.
     *
     * @return  self
     */
    public function setProperties(ChatProperties $properties)
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * Get the last message in this conversation.
     *
     * @return  Message
     */
    public function getLastMessage()
    {
        return $this->lastMessage;
    }

    /**
     * Set the last message in this conversation.
     *
     * @param  Message  $lastMessage  The last message in this conversation.
     *
     * @return  self
     */
    public function setLastMessage(Message $lastMessage)
    {
        $this->lastMessage = $lastMessage;

        return $this;
    }

    /**
     * Get the messages in this conversation.
     *
     * @return  string
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Set the messages in this conversation.
     *
     * @param  string  $messages  The messages in this conversation.
     *
     * @return  self
     */
    public function setMessages(string $messages)
    {
        $this->messages = $messages;

        return $this;
    }

    /**
     * Get the last updated message id in this conversation.
     *
     * @return  int
     */
    public function getLastUpdatedMessageId()
    {
        return $this->lastUpdatedMessageId;
    }

    /**
     * Set the last updated message id in this conversation.
     *
     * @param  int  $lastUpdatedMessageId  The last updated message id in this conversation.
     *
     * @return  self
     */
    public function setLastUpdatedMessageId(int $lastUpdatedMessageId)
    {
        $this->lastUpdatedMessageId = $lastUpdatedMessageId;

        return $this;
    }

    /**
     * Get the last updated message version in this conversation.
     *
     * @return  int
     */
    public function getLastUpdatedMessageVersion()
    {
        return $this->lastUpdatedMessageVersion;
    }

    /**
     * Set the last updated message version in this conversation.
     *
     * @param  int  $lastUpdatedMessageVersion  The last updated message version in this conversation.
     *
     * @return  self
     */
    public function setLastUpdatedMessageVersion(int $lastUpdatedMessageVersion)
    {
        $this->lastUpdatedMessageVersion = $lastUpdatedMessageVersion;

        return $this;
    }

    /**
     * Get the list of members in this conversation.
     *
     * @return  string[]
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Set the list of members in this conversation.
     *
     * @param  string[]  $members  The list of members in this conversation.
     *
     * @return  self
     */
    public function setMembers(array $members)
    {
        $this->members = $members;

        return $this;
    }

    /**
     * Get description of the conversation, shown to all participants.
     *
     * @return  string
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set description of the conversation, shown to all participants.
     *
     * @param  string  $topic  Description of the conversation, shown to all participants.
     *
     * @return  self
     */
    public function setTopic(string $topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get user who originally created the conversation.
     *
     * @return  string
     */
    public function getCreatorId()
    {
        return $this->creatorId;
    }

    /**
     * Set user who originally created the conversation.
     *
     * @param  string  $creatorId  User who originally created the conversation.
     *
     * @return  self
     */
    public function setCreatorId(string $creatorId)
    {
        $this->creatorId = $creatorId;

        return $this;
    }
}
