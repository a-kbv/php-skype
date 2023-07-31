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
     * Get the topic for this thread.
     *
     * @return  string
     */
    public function getTopic()
    {
        return $this->topic;
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
     * Get the members for this thread.
     *
     * @return  string
     */
    public function getMembers()
    {
        return $this->members;
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
     * Get the joiningenabled for this thread.
     *
     * @return  string
     */
    public function getJoiningEnabled()
    {
        return $this->joiningEnabled;
    }
}
