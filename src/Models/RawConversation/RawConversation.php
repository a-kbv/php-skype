<?php

namespace Akbv\PhpSkype\Models\RawConversation;
use JsonSerializable;
/**
 * A raw conversation model.
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class RawConversation extends \Akbv\PhpSkype\Models\Base implements JsonSerializable
{
    /**
     * The unique identifier for this conversation.
     * @var string
     */
    private $targetLink;

    /**
     * The properties of this conversation.
     * @var ThreadProperties
     */
    private $threadProperties;

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
     * The version of this conversation.
     * @var int
     */
    private $version;

    /**
     * The properties of this conversation.
     * @var Properties
     */
    private $properties;

    /**
     * The last message in this conversation.
     * @var \Akbv\PhpSkype\Models\Message
     */
    private $lastMessage;


    /**
     * Constructor.
     * @param mixed[] $data
     */
    public function __construct(array $data)
    {
        $this->mapPropertiesFromArray($data);
        $this->threadProperties = new ThreadProperties(isset($data['threadProperties'])? $data['threadProperties'] : []);
        $this->properties = new Properties(isset($data['properties'])? $data['properties'] : []);
        $this->lastMessage = new \Akbv\PhpSkype\Models\Message(isset($data['lastMessage'])? $data['lastMessage'] : []);
    }

    public function jsonSerialize(): array
    {
        $reflectedClass = new \ReflectionClass($this);
        $propertiesArray = [];

        foreach ($reflectedClass->getProperties() as $property) {
            $property->setAccessible(true);
            $propertyName = $property->getName();
            $propertyValue = $property->getValue($this);

            if (is_object($propertyValue) && method_exists($propertyValue, 'mapPropertiesToArray')) {
                $propertiesArray[$propertyName] = $propertyValue->toArray();
            } else {
                $propertiesArray[$propertyName] = $propertyValue;
            }
        }

        return $propertiesArray;
    }

    /**
     * Get the unique identifier for this conversation.
     *
     * @return  string
     */
    public function getTargetLink()
    {
        return $this->targetLink;
    }

    /**
     * Set the unique identifier for this conversation.
     *
     * @param  string  $targetLink  The unique identifier for this conversation.
     *
     * @return  self
     */
    public function setTargetLink(string $targetLink)
    {
        $this->targetLink = $targetLink;

        return $this;
    }

    /**
     * Get the properties of this conversation.
     *
     * @return  ThreadProperties
     */
    public function getThreadProperties()
    {
        return $this->threadProperties;
    }

    /**
     * Set the properties of this conversation.
     *
     * @param  ThreadProperties  $threadProperties  The properties of this conversation.
     *
     * @return  self
     */
    public function setThreadProperties(ThreadProperties $threadProperties)
    {
        $this->threadProperties = $threadProperties;

        return $this;
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
     * @return  Properties
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Set the properties of this conversation.
     *
     * @param  Properties  $properties  The properties of this conversation.
     *
     * @return  self
     */
    public function setProperties(Properties $properties)
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * Get the last message in this conversation.
     *
     * @return  \Akbv\PhpSkype\Models\Message
     */
    public function getLastMessage()
    {
        return $this->lastMessage;
    }

    /**
     * Set the last message in this conversation.
     *
     * @param  \Akbv\PhpSkype\Models\Message  $lastMessage  The last message in this conversation.
     *
     * @return  self
     */
    public function setLastMessage(\Akbv\PhpSkype\Models\Message $lastMessage)
    {
        $this->lastMessage = $lastMessage;

        return $this;
    }
}
