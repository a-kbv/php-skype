<?php

namespace Akbv\PhpSkype\Model\SkypeChat;
/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SkypeChat extends \Akbv\PhpSkype\Model\Base
{

    /**
     * Unique identifier of the conversation.
     * One-to-one chats have identifiers of the form <type>:<username>.
     * Cloud group chat identifiers are of the form <type>:<identifier>@thread.skype.
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $targetLink;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $version;

    /**
     * @var \Akbv\PhpSkype\Model\SkypeChat\SkypeChatProperties
     */
    private $properties;

    /**
     * @var \Akbv\PhpSkype\Model\SkypeChat\SkypeChatThreadProperties
     */
    private $threadProperties;

    /**
     * @var \Akbv\PhpSkype\Model\SkypeMessage\SkypeMessage
     */
    private $lastMessage;

    /**
     * messages
     * @var string
     */
    private $messagesUrl;




    public function __construct($raw)
    {
        $this->fromArray($raw);
    }

    public function toArray()
    {
        $conversationData['id'] = $this->id;
        $conversationData['targetLink'] = $this->targetLink;
        $conversationData['type'] = $this->type;
        $conversationData['version'] = $this->version;
        $conversationData['properties'] = !empty($this->properties) ? $this->properties->toArray() : null;
        $conversationData['threadProperties'] = !empty($this->threadProperties) ? $this->threadProperties->toArray() : null;
        $conversationData['lastMessage'] = !empty($this->lastMessage) ? $this->lastMessage->toArray() : null;
        $conversationData['messages'] = $this->messagesUrl;

        return $conversationData;
    }

    private function fromArray($raw)
    {
        if (!is_object($raw)) {
            $raw = (object) $raw;
        }
        $this->id = !empty($raw->id) ? $raw->id : null;
        $this->targetLink = !empty($raw->targetLink) ? $raw->targetLink : null;
        $this->type = !empty($raw->type) ? $raw->type : null;
        $this->version = !empty($raw->version) ? $raw->version : null;
        $this->properties = !empty($raw->properties) ? new \Akbv\PhpSkype\Model\SkypeChat\SkypeChatProperties($raw->properties) : null;
        $this->threadProperties = !empty($raw->threadProperties) ? new \Akbv\PhpSkype\Model\SkypeChat\SkypeChatThreadProperties($raw->threadProperties) : null;
        $this->lastMessage = !empty($raw->lastMessage) ? new \Akbv\PhpSkype\Model\SkypeMessage\SkypeMessage($raw->lastMessage) : null;
        $this->messagesUrl = !empty($raw->messages) ? $raw->messages : null;
    }

    /**
     * Get cloud group chat identifiers are of the form <type>:<identifier>@thread.skype.
     *
     * @return  string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cloud group chat identifiers are of the form <type>:<identifier>@thread.skype.
     *
     * @param  string  $id  Cloud group chat identifiers are of the form <type>:<identifier>@thread.skype.
     *
     * @return  self
     */
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of targetLink
     *
     * @return  string
     */
    public function getTargetLink()
    {
        return $this->targetLink;
    }

    /**
     * Set the value of targetLink
     *
     * @param  string  $targetLink
     *
     * @return  self
     */
    public function setTargetLink(string $targetLink)
    {
        $this->targetLink = $targetLink;

        return $this;
    }

    /**
     * Get the value of type
     *
     * @return  string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @param  string  $type
     *
     * @return  self
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of version
     *
     * @return  string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set the value of version
     *
     * @param  string  $version
     *
     * @return  self
     */
    public function setVersion(string $version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get the value of properties
     *
     * @return  \Akbv\PhpSkype\Model\SkypeChat\SkypeChatProperties
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Set the value of properties
     *
     * @param  \Akbv\PhpSkype\Model\SkypeChat\SkypeChatProperties  $properties
     *
     * @return  self
     */
    public function setProperties(\Akbv\PhpSkype\Model\SkypeChat\SkypeChatProperties $properties)
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * Get the value of threadProperties
     *
     * @return  \Akbv\PhpSkype\Model\SkypeChat\SkypeChatThreadProperties
     */
    public function getThreadProperties()
    {
        return $this->threadProperties;
    }

    /**
     * Set the value of threadProperties
     *
     * @param  \Akbv\PhpSkype\Model\SkypeChat\SkypeChatThreadProperties  $threadProperties
     *
     * @return  self
     */
    public function setThreadProperties(\Akbv\PhpSkype\Model\SkypeChat\SkypeChatThreadProperties $threadProperties)
    {
        $this->threadProperties = $threadProperties;

        return $this;
    }

    /**
     * Get the value of lastMessage
     *
     * @return  \Akbv\PhpSkype\Model\SkypeMessage\SkypeMessage
     */
    public function getLastMessage()
    {
        return $this->lastMessage;
    }

    /**
     * Set the value of lastMessage
     *
     * @param  \Akbv\PhpSkype\Model\SkypeMessage\SkypeMessage  $lastMessage
     *
     * @return  self
     */
    public function setLastMessage(\Akbv\PhpSkype\Model\SkypeMessage\SkypeMessage $lastMessage)
    {
        $this->lastMessage = $lastMessage;

        return $this;
    }

    /**
     * Get messages
     *
     * @return  string
     */
    public function getMessagesUrl()
    {
        return $this->messagesUrl;
    }

    /**
     * Set messages
     *
     * @param  string  $messagesUrl  messages
     *
     * @return  self
     */
    public function setMessagesUrl(string $messagesUrl)
    {
        $this->messagesUrl = $messagesUrl;

        return $this;
    }
}
