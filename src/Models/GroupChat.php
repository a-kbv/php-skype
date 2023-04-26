<?php

namespace Akbv\PhpSkype\Models;

/**
 *  A group conversation within Skype. Compared to single chats, groups have a topic and participant list.
 *
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Atanas Korabov
 */
class GroupChat extends Base
{
    /**
     * The unique identifier for this conversation.
     * @var string
     */
    private $id;

    /**
     * The type of this conversation.
     * @var string
     */
    private $type;

    /**
     * The properties of this conversation.
     * @var mixed[]
     */
    private $properties;

    /**
     * The list of members in this conversation.
     * @var mixed[]
     */
    private $members;

    /**
     * The version of this conversation.
     * @var int
     */
    private $version;

    /**
     * The messages in this conversation.
     * @var string
     */
    private $messages;

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
     * Get the properties of this conversation.
     *
     * @return  mixed[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Set the properties of this conversation.
     *
     * @param  mixed[]  $properties  The properties of this conversation.
     *
     * @return  self
     */
    public function setProperties(array $properties)
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * Get the list of members in this conversation.
     *
     * @return  mixed[]
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Set the list of members in this conversation.
     *
     * @param  mixed[]  $members  The list of members in this conversation.
     *
     * @return  self
     */
    public function setMembers(array $members)
    {
        $this->members = $members;

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
