<?php

namespace Akbv\PhpSkype\Model\SkypeEvent;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SkypeEventResourceThreadProperties
{
    /**
    * The lastjoinat for this thread.
    * @var string
    */
    private $lastJoinAt;

    /**
     * The topic for this thread.
     * @var string
     */
    private $topic;

    /**
     * The membercount for this thread.
     * @var string
     */
    private $memberCount;

    /**
     * The members for this thread.
     * @var string
     */
    private $members;

    /**
     * The version for this thread.
     * @var string
     */
    private $version;

    /**
     * The joiningenabled for this thread.
     * @var string
     */
    private $joiningEnabled;


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
        $data['lastjoinat'] = $this->lastJoinAt;
        $data['topic'] = $this->topic;
        $data['membercount'] = $this->memberCount;
        $data['members'] = $this->members;
        $data['version'] = $this->version;
        $data['joiningenabled'] = $this->joiningEnabled;

        return $data;
    }

    private function fromArray($raw)
    {
        if (!is_object($raw)) {
            $raw = (object) $raw;
        }
        $this->lastJoinAt = !empty($raw->lastjoinat) ? $raw->lastjoinat : null;
        $this->topic = !empty($raw->topic) ? $raw->topic : null;
        $this->memberCount = !empty($raw->membercount) ? $raw->membercount : null;
        $this->members = !empty($raw->members) ? $raw->members : null;
        $this->version = !empty($raw->version) ? $raw->version : null;
        $this->joiningEnabled = !empty($raw->joiningenabled) ? $raw->joiningenabled : null;
    }





    /**
     * Get the lastjoinat for this thread.
     *
     * @return  string
     */
    public function getLastJoinAt()
    {
        return $this->lastJoinAt;
    }

    /**
     * Set the lastjoinat for this thread.
     *
     * @param  string  $lastJoinAt  The lastjoinat for this thread.
     *
     * @return  self
     */
    public function setLastJoinAt(string $lastJoinAt)
    {
        $this->lastJoinAt = $lastJoinAt;

        return $this;
    }

    /**
     * Get the topic for this thread.
     *
     * @return  string
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set the topic for this thread.
     *
     * @param  string  $topic  The topic for this thread.
     *
     * @return  self
     */
    public function setTopic(string $topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get the membercount for this thread.
     *
     * @return  string
     */
    public function getMemberCount()
    {
        return $this->memberCount;
    }

    /**
     * Set the membercount for this thread.
     *
     * @param  string  $memberCount  The membercount for this thread.
     *
     * @return  self
     */
    public function setMemberCount(string $memberCount)
    {
        $this->memberCount = $memberCount;

        return $this;
    }

    /**
     * Get the members for this thread.
     *
     * @return  string
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Set the members for this thread.
     *
     * @param  string  $members  The members for this thread.
     *
     * @return  self
     */
    public function setMembers(string $members)
    {
        $this->members = $members;

        return $this;
    }

    /**
     * Get the version for this thread.
     *
     * @return  string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set the version for this thread.
     *
     * @param  string  $version  The version for this thread.
     *
     * @return  self
     */
    public function setVersion(string $version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get the joiningenabled for this thread.
     *
     * @return  string
     */
    public function getJoiningEnabled()
    {
        return $this->joiningEnabled;
    }

    /**
     * Set the joiningenabled for this thread.
     *
     * @param  string  $joiningEnabled  The joiningenabled for this thread.
     *
     * @return  self
     */
    public function setJoiningEnabled(string $joiningEnabled)
    {
        $this->joiningEnabled = $joiningEnabled;

        return $this;
    }
}
