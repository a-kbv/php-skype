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
        $this->lastJoinAt = !empty($raw->lastjoinat) ? $raw->lastjoinat : null;
        $this->topic = !empty($raw->topic) ? $raw->topic : null;
        $this->memberCount = !empty($raw->membercount) ? $raw->membercount : null;
        $this->members = !empty($raw->members) ? $raw->members : null;
        $this->version = !empty($raw->version) ? $raw->version : null;
        $this->joiningEnabled = !empty($raw->joiningenabled) ? $raw->joiningenabled : null;
    }

}
