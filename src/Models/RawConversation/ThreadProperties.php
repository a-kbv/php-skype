<?php

namespace Akbv\PhpSkype\Models\RawConversation;

/**
 * A raw threadProperties
 *
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class ThreadProperties extends \Akbv\PhpSkype\Models\Base
{
    /**
     * The Title this conversation.
     * @var string
     */
    private $topic;

    /**
     * The last join at this conversation.
     * @var string
     */
    private $lastjoinat;

    /**
     * The member count this conversation.
     * @var string
     */
    private $membercount;

    /**
     * The version this conversation.
     * @var string
     */
    private $version;

    /**
     * The members this conversation.
     * @var string
     */
    private $members;

    /**
     * The joining enabled this conversation.
     * @var string
     */
    private $joiningenabled;

    /**
     * The last leave at this conversation.
     * @var string
     */
    private $lastleaveat;

    /**
     * The picture this conversation.
     * @var string
     */
    private $picture;

    /**
     * Constructor.
     * @param mixed[] $data
     */
    public function __construct(array $data)
    {
        $this->mapPropertiesFromArray($data);
        parent::jsonSerialize();
    }

    /**
     * Get the Title this conversation.
     *
     * @return  string
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set the Title this conversation.
     *
     * @param  string  $topic  The Title this conversation.
     *
     * @return  self
     */
    public function setTopic(string $topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get the last join at this conversation.
     *
     * @return  string
     */
    public function getLastjoinat()
    {
        return $this->lastjoinat;
    }

    /**
     * Set the last join at this conversation.
     *
     * @param  string  $lastjoinat  The last join at this conversation.
     *
     * @return  self
     */
    public function setLastjoinat(string $lastjoinat)
    {
        $this->lastjoinat = $lastjoinat;

        return $this;
    }

    /**
     * Get the member count this conversation.
     *
     * @return  string
     */
    public function getMembercount()
    {
        return $this->membercount;
    }

    /**
     * Set the member count this conversation.
     *
     * @param  string  $membercount  The member count this conversation.
     *
     * @return  self
     */
    public function setMembercount(string $membercount)
    {
        $this->membercount = $membercount;

        return $this;
    }

    /**
     * Get the version this conversation.
     *
     * @return  string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set the version this conversation.
     *
     * @param  string  $version  The version this conversation.
     *
     * @return  self
     */
    public function setVersion(string $version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get the members this conversation.
     *
     * @return  string
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Set the members this conversation.
     *
     * @param  string  $members  The members this conversation.
     *
     * @return  self
     */
    public function setMembers(string $members)
    {
        $this->members = $members;

        return $this;
    }

    /**
     * Get the joining enabled this conversation.
     *
     * @return  string
     */
    public function getJoiningenabled()
    {
        return $this->joiningenabled;
    }

    /**
     * Set the joining enabled this conversation.
     *
     * @param  string  $joiningenabled  The joining enabled this conversation.
     *
     * @return  self
     */
    public function setJoiningenabled(string $joiningenabled)
    {
        $this->joiningenabled = $joiningenabled;

        return $this;
    }

    /**
     * Get the last leave at this conversation.
     *
     * @return  string
     */
    public function getLastleaveat()
    {
        return $this->lastleaveat;
    }

    /**
     * Set the last leave at this conversation.
     *
     * @param  string  $lastleaveat  The last leave at this conversation.
     *
     * @return  self
     */
    public function setLastleaveat(string $lastleaveat)
    {
        $this->lastleaveat = $lastleaveat;

        return $this;
    }

    /**
     * Get the picture this conversation.
     *
     * @return  string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the picture this conversation.
     *
     * @param  string  $picture  The picture this conversation.
     *
     * @return  self
     */
    public function setPicture(string $picture)
    {
        $this->picture = $picture;

        return $this;
    }
}
