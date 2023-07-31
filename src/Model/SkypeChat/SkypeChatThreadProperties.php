<?php

namespace Akbv\PhpSkype\Model\SkypeChat;

/**
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
class SkypeChatThreadProperties {
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
        $this->topic = !empty($raw->topic) ? $raw->topic : null;
        $this->lastJoinAt = !empty($raw->lastjoinat) ? $raw->lastjoinat : null;
        $this->memberCount = !empty($raw->membercount) ? $raw->membercount : null;
        $this->version = !empty($raw->version) ? $raw->version : null;
        $this->members = !empty($raw->members) ? $raw->members : null;
        $this->joiningEnabled = !empty($raw->joiningenabled) ? $raw->joiningenabled : null;
        $this->lastLeaveAt = !empty($raw->lastleaveat) ? $raw->lastleaveat : null;
        $this->picture = !empty($raw->picture) ? $raw->picture : null;
    }
}