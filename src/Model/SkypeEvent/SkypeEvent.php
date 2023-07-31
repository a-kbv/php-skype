<?php

namespace Akbv\PhpSkype\Model\SkypeEvent;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SkypeEvent
{
    /**
     * The unique identifier for this event.
     * @var string
     */
    private $id;

    /**
     * The type of this event.
     * @var string
     */
    private $type;

    /**
     * The resource type of this event.
     * @var string
     */
    private $resourceType;

    /**
     * The time of this event.
     * @var string
     */
    private $time;

    /**
     * The resource link of this event.
     * @var string
     */
    private $resourceLink;

    /**
     * The resource of this event.
     * @var \Akbv\PhpSkype\Model\SkypeEvent\SkypeEventResource
     */
    private $resource;

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
        $data['id'] = $this->id;
        $data['type'] = $this->type;
        $data['resourceType'] = $this->resourceType;
        $data['time'] = $this->time;
        $data['resourceLink'] = $this->resourceLink;
        $data['resource'] = $this->resource->toArray();
        return $data;
    }

    private function fromArray($raw)
    {
        if (!is_object($raw)) {
            $raw = (object) $raw;
        }
        $this->id = !empty($raw->id) ? $raw->id : null;
        $this->type = !empty($raw->type) ? $raw->type : null;
        $this->resourceType = !empty($raw->resourceType) ? $raw->resourceType : null;
        $this->time = !empty($raw->time) ? $raw->time : null;
        $this->resourceLink = !empty($raw->resourceLink) ? $raw->resourceLink : null;
        $this->resource = new \Akbv\PhpSkype\Model\SkypeEvent\SkypeEventResource((!empty($raw->resource) ? $raw->resource : (object)[]));

    }


    /**
     * Get the unique identifier for this event.
     *
     * @return  string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the unique identifier for this event.
     *
     * @param  string  $id  The unique identifier for this event.
     *
     * @return  self
     */
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the type of this event.
     *
     * @return  string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the type of this event.
     *
     * @param  string  $type  The type of this event.
     *
     * @return  self
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the resource type of this event.
     *
     * @return  string
     */
    public function getResourceType()
    {
        return $this->resourceType;
    }

    /**
     * Set the resource type of this event.
     *
     * @param  string  $resourceType  The resource type of this event.
     *
     * @return  self
     */
    public function setResourceType(string $resourceType)
    {
        $this->resourceType = $resourceType;

        return $this;
    }

    /**
     * Get the time of this event.
     *
     * @return  string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set the time of this event.
     *
     * @param  string  $time  The time of this event.
     *
     * @return  self
     */
    public function setTime(string $time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get the resource link of this event.
     *
     * @return  string
     */
    public function getResourceLink()
    {
        return $this->resourceLink;
    }

    /**
     * Set the resource link of this event.
     *
     * @param  string  $resourceLink  The resource link of this event.
     *
     * @return  self
     */
    public function setResourceLink(string $resourceLink)
    {
        $this->resourceLink = $resourceLink;

        return $this;
    }

    /**
     * Get the resource of this event.
     *
     * @return  \Akbv\PhpSkype\Model\SkypeEvent\SkypeEventResource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set the resource of this event.
     *
     * @param \Akbv\PhpSkype\Model\SkypeEvent\SkypeEventResource  $resource  The resource of this event.
     *
     * @return  self
     */
    public function setResource(\Akbv\PhpSkype\Model\SkypeEvent\SkypeEventResource $resource)
    {
        $this->resource = $resource;

        return $this;
    }
}
