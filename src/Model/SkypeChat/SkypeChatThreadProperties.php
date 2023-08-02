<?php

namespace Akbv\PhpSkype\Model\SkypeChat;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SkypeChatThreadProperties extends \Akbv\PhpSkype\Model\Base
{
     /**
     * The Title this conversation.
     * @var string
     */
    private $topic;

    /**
     * The last join at this conversation.
     * lastjoinat
     * @var string
     */
    private $lastJoinAt;

    /**
     * The member count this conversation.
     * membercount
     * @var string
     */
    private $memberCount;

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
     * joiningenabled
     * @var string
     */
    private $joiningEnabled;

    /**
     * The last leave at this conversation.
     * lastleaveat
     * @var string
     */
    private $lastLeaveAt;

    /**
     * The picture this conversation.
     * @var string
     */
    private $picture;

    public function __construct($raw)
    {
        $this->fromArray($raw);
    }

    public function toArray()
    {
        $conversationData['topic'] = $this->topic;
        $conversationData['lastjoinat'] = $this->lastJoinAt;
        $conversationData['membercount'] = $this->memberCount;
        $conversationData['version'] = $this->version;
        $conversationData['members'] = $this->members;
        $conversationData['joiningenabled'] = $this->joiningEnabled;
        $conversationData['lastleaveat'] = $this->lastLeaveAt;
        $conversationData['picture'] = $this->picture;

        return $conversationData;
    }

    private function fromArray($raw)
    {
        if (!is_object($raw)) {
            $raw = (object) $raw;
        }
        $this->topic = !empty($raw->topic) ? $raw->topic : null;
        $this->lastJoinAt = !empty($raw->lastjoinat) ? $raw->lastjoinat : null;
        $this->memberCount = !empty($raw->membercount) ? $raw->membercount : null;
        $this->version = !empty($raw->version) ? $raw->version : null;
        $this->members = !empty($raw->members) ? $raw->members : null;
        $this->joiningEnabled = !empty($raw->joiningenabled) ? $raw->joiningenabled : null;
        $this->lastLeaveAt = !empty($raw->lastleaveat) ? $raw->lastleaveat : null;
        $this->picture = !empty($raw->picture) ? $raw->picture : null;
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
     * Get lastjoinat
     *
     * @return  string
     */
    public function getLastJoinAt()
    {
        return $this->lastJoinAt;
    }

    /**
     * Set lastjoinat
     *
     * @param  string  $lastJoinAt  lastjoinat
     *
     * @return  self
     */
    public function setLastJoinAt(string $lastJoinAt)
    {
        $this->lastJoinAt = $lastJoinAt;

        return $this;
    }

    /**
     * Get membercount
     *
     * @return  string
     */
    public function getMemberCount()
    {
        return $this->memberCount;
    }

    /**
     * Set membercount
     *
     * @param  string  $memberCount  membercount
     *
     * @return  self
     */
    public function setMemberCount(string $memberCount)
    {
        $this->memberCount = $memberCount;

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
     * Get joiningenabled
     *
     * @return  string
     */
    public function getJoiningEnabled()
    {
        return $this->joiningEnabled;
    }

    /**
     * Set joiningenabled
     *
     * @param  string  $joiningEnabled  joiningenabled
     *
     * @return  self
     */
    public function setJoiningEnabled(string $joiningEnabled)
    {
        $this->joiningEnabled = $joiningEnabled;

        return $this;
    }

    /**
     * Get lastleaveat
     *
     * @return  string
     */
    public function getLastLeaveAt()
    {
        return $this->lastLeaveAt;
    }

    /**
     * Set lastleaveat
     *
     * @param  string  $lastLeaveAt  lastleaveat
     *
     * @return  self
     */
    public function setLastLeaveAt(string $lastLeaveAt)
    {
        $this->lastLeaveAt = $lastLeaveAt;

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
