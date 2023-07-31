<?php

namespace Akbv\PhpSkype\Model\SkypeChat;
/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SkypeChat {

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
        $conversationData['properties'] = $this->properties->toArray();
        $conversationData['threadProperties'] = $this->threadProperties->toArray();
        $conversationData['lastMessage'] = $this->lastMessage->toArray();
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
     * Get the value of id
     *
     * @return  string
     */
    public function getId()
    {
        return $this->id;
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
     * Get the value of type
     *
     * @return  string
     */
    public function getType()
    {
        return $this->type;
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
     * Get the value of properties
     *
     * @return  \Akbv\PhpSkype\Model\SkypeChat\SkypeChatProperties
     */
    public function getProperties()
    {
        return $this->properties;
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
     * Get the value of lastMessage
     *
     * @return  \Akbv\PhpSkype\Model\SkypeMessage\SkypeMessage
     */
    public function getLastMessage()
    {
        return $this->lastMessage;
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
}
